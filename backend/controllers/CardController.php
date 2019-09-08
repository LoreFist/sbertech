<?php

namespace backend\controllers;

use Yii;
use common\models\Card;
use yii\data\ActiveDataProvider;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CardController implements the CRUD actions for Card model.
 */
class CardController extends Controller
{

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        Yii::$app->name = 'Backed app ';

        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Card models.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Card::find()
                ->joinWith(['counts', 'counts.type']),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Card model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     *
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Card();

        if ($model->load(Yii::$app->request->post())) {

            $model->image_url = $this->imageUpload($model)['name'];

            if ($model->validate()) {
                if ($model->save()) {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Card model.
     * If update is successful, the browser will be redirected to the 'view' page.
     *
     * @param  integer  $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model       = $this->findModel($id);
        $oldImageUrl = $model->image_url;

        if ($model->load(Yii::$app->request->post())) {

            $model->image_url = $this->imageUpload($model, $oldImageUrl)['name'];
            if ($model->validate()) {
                if ($model->save()) {
                    return $this->redirect(['index']);
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    private function imageUpload($model, $oldImageUrl)
    {
        $imageFile = UploadedFile::getInstance($model, 'image_url');

        $directory = Yii::getAlias(Yii::$app->params['path_card_image']);
        if ( ! is_dir($directory)) {
            FileHelper::createDirectory($directory);
        }

        if ($imageFile) {
            $uid      = uniqid(time(), true);
            $fileName = $uid.'.'.$imageFile->extension;
            $filePath = $directory.$fileName;
            if ($imageFile->saveAs($filePath)) {
                $path = Yii::$app->params['path_card_image'].Yii::$app->session->id.DIRECTORY_SEPARATOR.$fileName;

                return
                    [
                        'file' => $imageFile,
                        'name' => $fileName,
                        'size' => $imageFile->size,
                        'url'  => $path,
                        'path' => Url::to('@card_path_image/'.$fileName),
                    ];

            }
        }

        return ['name' => $oldImageUrl];
    }

    /**
     * Deletes an existing Card model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     *
     * @param  integer  $id
     *
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);

        $directory = Yii::getAlias(Yii::$app->params['path_card_image']);

        if ($model->delete()) {
            unlink($directory.$model->image_url);
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Card model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     *
     * @param  integer  $id
     *
     * @return Card the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Card::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
