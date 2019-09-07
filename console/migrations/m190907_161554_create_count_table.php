<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%count}}`.
 */
class m190907_161554_create_count_table extends Migration
{

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%count}}', [
            'id'         => $this->primaryKey(),
            'card_id'    => $this->integer()->notNull(),
            'type_id'    => $this->integer()->notNull(),
            'created_at' => $this->timestamp()->notNull()->defaultExpression('CURRENT_TIMESTAMP'),
        ]);

        $this->createIndex(
            'idx-count-id',
            '{{%count}}',
            'id'
        );

        $this->createIndex(
            'idx-count-card_id',
            '{{%count}}',
            'card_id'
        );

        $this->createIndex(
            'idx-count-type_id',
            '{{%count}}',
            'type_id'
        );

        $this->addForeignKey(
            'fk-count-card_id',
            '{{%count}}',
            'card_id',
            '{{%card}}',
            'id',
            'NO ACTION'
        );

        $this->addForeignKey(
            'fk-count-type_id',
            '{{%count}}',
            'type_id',
            '{{%count_type}}',
            'id',
            'NO ACTION'
        );

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            'fk-count-card_id',
            '{{%count}}'
        );

        $this->dropForeignKey(
            'fk-count-type_id',
            '{{%count}}'
        );

        $this->dropIndex(
            'idx-count-id',
            '{{%count}}'
        );

        $this->dropIndex(
            'idx-count-card_id',
            '{{%count}}'
        );

        $this->dropTable('{{%count}}');
    }

}
