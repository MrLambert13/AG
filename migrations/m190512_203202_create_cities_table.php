<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%cities}}`.
 * Has foreign keys to the tables:
 * - `{{%regions}}`
 */
class m190512_203202_create_cities_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%cities}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'timezone' => $this->tinyInteger(),
            'id_region' => $this->integer(),
        ]);

        // creates index for column `id_region`
        $this->createIndex(
            '{{%idx-cities-id_region}}',
            '{{%cities}}',
            'id_region'
        );

        // add foreign key for table `{{%regions}}`
        $this->addForeignKey(
            '{{%fk-cities-id_region}}',
            '{{%cities}}',
            'id_region',
            '{{%regions}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%regions}}`
        $this->dropForeignKey(
            '{{%fk-cities-id_region}}',
            '{{%cities}}'
        );

        // drops index for column `id_region`
        $this->dropIndex(
            '{{%idx-cities-id_region}}',
            '{{%cities}}'
        );

        $this->dropTable('{{%cities}}');
    }
}
