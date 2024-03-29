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
            'id'          => $this->primaryKey(),
            'name'        => $this->string()->notNull(),
            'description' => $this->text()->notNull(),
            'image_url'   => $this->string()->notNull(),
            'created_at'  => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
            'updated_at'  => $this->timestamp()->append('ON UPDATE CURRENT_TIMESTAMP'),
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
