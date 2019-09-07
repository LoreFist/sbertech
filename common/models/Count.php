<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "count".
 *
 * @property int $id
 * @property int $card_id
 * @property int $type_id
 *
 * @property Card $card
 * @property Card $card0
 * @property CountType $type
 */
class Count extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'count';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['card_id', 'type_id'], 'required'],
            [['card_id', 'type_id'], 'integer'],
            [['card_id'], 'exist', 'skipOnError' => true, 'targetClass' => Card::className(), 'targetAttribute' => ['card_id' => 'id']],
            [['type_id'], 'exist', 'skipOnError' => true, 'targetClass' => CountType::className(), 'targetAttribute' => ['type_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'card_id' => 'Card ID',
            'type_id' => 'Type ID',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCard()
    {
        return $this->hasOne(Card::className(), ['id' => 'card_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCard0()
    {
        return $this->hasOne(Card::className(), ['id' => 'card_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getType()
    {
        return $this->hasOne(CountType::className(), ['id' => 'type_id']);
    }
}
