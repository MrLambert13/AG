<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%transmissions}}`.
 */
class m190512_203516_create_transmissions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%transmissions}}', [
            'id' => $this->primaryKey(),
            'name' => 'ENUM("АКПП-гидро", "АКПП-робот", "АКПП-вариатор", "МКПП")',
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%transmissions}}');
    }
}
