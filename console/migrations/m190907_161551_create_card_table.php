<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%card}}`.
 */
class m190907_161551_create_card_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%card}}', [
            'id' => $this->primaryKey(),
            'name'=> $this->string(),
            'description'=> $this->text(),
            'image_url'=> $this->string(),
        ]);

        $this->createIndex(
            'idx-card-id',
            '{{%card}}',
            'id'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-card-id',
            '{{%card}}'
        );

        $this->dropTable('{{%card}}');
    }
}
