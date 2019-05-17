<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%request_statuses}}`.
 */
class m190512_203546_create_request_statuses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%request_statuses}}', [
            'id' => $this->primaryKey(),
            'name' => 'ENUM("Создана","В работе","Приостановлена","Выполнена")',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%request_statuses}}');
    }
}
