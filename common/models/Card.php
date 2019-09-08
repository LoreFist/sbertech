<?php

namespace common\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "card".
 *
 * @property int     $id
 * @property string  $name
 * @property string  $description
 * @property string  $image_url
 * @property string  $created_at
 * @property string  $updated_at
 *
 * @property Count[] $counts
 */
class Card extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'card';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description'], 'required'],
            [['image_url'], 'required', 'on' => 'create'],
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'image_url'], 'string', 'max' => 255],
            [['image_url'], 'file', 'extensions' => 'jpg, jpeg, png'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'          => 'ID',
            'name'        => 'Name',
            'description' => 'Description',
            'image_url'   => 'Image Url',
            'created_at'  => 'Created At',
            'updated_at'  => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCounts()
    {
        return $this->hasMany(Count::className(), ['card_id' => 'id']);
    }

    public function getCardimage()
    {
        return Url::to('@card_path_image/'.$this->image_url);
    }

    public function getViewCount()
    {
        $inc = 0;
        foreach ($this->counts as $card_count) {
            if ($card_count->type->name == 'view') {
                $inc++;
            }
        }

        return $inc;
    }

}
