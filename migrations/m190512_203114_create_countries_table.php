<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%countries}}`.
 * Has foreign keys to the tables:
 * - `{{%currency}}`
 */
class m190512_203114_create_countries_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%countries}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'id_currency' => $this->integer(),
        ]);

        // creates index for column `id_currency`
        $this->createIndex(
            '{{%idx-countries-id_currency}}',
            '{{%countries}}',
            'id_currency'
        );

        // add foreign key for table `{{%currency}}`
        $this->addForeignKey(
            '{{%fk-countries-id_currency}}',
            '{{%countries}}',
            'id_currency',
            '{{%currency}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%currency}}`
        $this->dropForeignKey(
            '{{%fk-countries-id_currency}}',
            '{{%countries}}'
        );

        // drops index for column `id_currency`
        $this->dropIndex(
            '{{%idx-countries-id_currency}}',
            '{{%countries}}'
        );

        $this->dropTable('{{%countries}}');
    }
}
