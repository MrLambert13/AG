<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%car_types}}`.
 */
class m190512_203413_create_car_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car_types}}');
    }
}
