<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%count_type}}`.
 */
class m190907_161553_create_count_type_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%count_type}}', [
            'id' => $this->primaryKey(),
            'name' => $this->text(),
        ]);

        $this->createIndex(
            'idx-count_type-id',
            '{{%count_type}}',
            'id'
        );

        $this->insert(
            '{{%count_type}}',
            ['name'=>'view']
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropIndex(
            'idx-count_type-id',
            '{{%count_type}}'
        );

        $this->dropTable('{{%count_type}}');
    }
}
