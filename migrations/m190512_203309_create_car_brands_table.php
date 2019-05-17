<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%car_brands}}`.
 */
class m190512_203309_create_car_brands_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_brands}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car_brands}}');
    }
}
