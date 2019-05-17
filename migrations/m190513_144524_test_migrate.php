<?php

use yii\db\Migration;

/**
 * Class m190513_144524_test_migrate
 */
class m190513_144524_test_migrate extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190513_144524_test_migrate cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190513_144524_test_migrate cannot be reverted.\n";

        return false;
    }
    */
}
