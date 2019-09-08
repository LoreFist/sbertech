<?php

namespace frontend\controllers;

use common\models\Count;
use Yii;
use yii\web\Controller;
use frontend\models\Card;


/**
 * Site controller
 */
class CardController extends Controller
{
    /**
     * Lists all Card.
     *
     * @return mixed
     */
    public function actionIndex()
    {
        $query = new \yii\elasticsearch\Query();
        $query->from(Yii::$app->params['index'], Yii::$app->params['type']);
        $query->limit(5);
        $query->orderBy('id DESC');
        $cards = $query->createCommand()->search()['hits']['hits'];

        return $this->render('index', [
            'cards' => $cards,
        ]);
    }

    /**
     * save view card
     */
    public function actionView()
    {
        $data           = Yii::$app->request->post()['data'];

        $count          = new Count();
        $count->card_id = $data['key'];
        $count->type_id = 1;
        $count->save();
    }

}
