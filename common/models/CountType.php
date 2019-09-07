<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "count_type".
 *
 * @property int     $id
 * @property string  $name
 *
 * @property Count[] $counts
 */
class CountType extends \yii\db\ActiveRecord
{

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'count_type';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id'   => 'ID',
            'name' => 'Name',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCounts()
    {
        return $this->hasMany(Count::className(), ['type_id' => 'id']);
    }

}
