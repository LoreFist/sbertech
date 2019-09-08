<?php

namespace backend\actions;

use Yii;
use yii\base\Action;
use yii\helpers\FileHelper;
use yii\helpers\Url;
use yii\web\UploadedFile;

class CardAction extends Action
{
    /**
     * action upload image card
     *
     * @param          $model
     * @param  string  $oldImageUrl
     *
     * @return array
     * @throws \yii\base\Exception
     */
    static public function imageUpload($model, $oldImageUrl='')
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
}