<?php

namespace common\models;

use Yii;

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
            [['description'], 'string'],
            [['created_at', 'updated_at'], 'safe'],
            [['name', 'image_url'], 'string', 'max' => 255],
            [['id'], 'exist', 'skipOnError' => true, 'targetClass' => Count::className(), 'targetAttribute' => ['id' => 'card_id']],
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

}
