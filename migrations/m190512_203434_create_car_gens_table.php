<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%car_gens}}`.
 */
class m190512_203434_create_car_gens_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_gens}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%car_gens}}');
    }
}
