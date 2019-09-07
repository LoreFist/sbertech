<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "card".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $image_url
 *
 * @property Count $id0
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
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'image_url' => 'Image Url',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(Count::className(), ['card_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCounts()
    {
        return $this->hasMany(Count::className(), ['card_id' => 'id']);
    }
}
