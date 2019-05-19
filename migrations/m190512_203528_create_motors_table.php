<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%motors}}`.
 */
class m190512_203528_create_motors_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%motors}}', [
            'id' => $this->primaryKey(),
            'name' => 'ENUM("бензин", "дизель", "электро", "гибрид-газ", "гибрид-электро")',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%motors}}');
    }
}
