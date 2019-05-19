<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%regions}}`.
 * Has foreign keys to the tables:
 * - `{{%countries}}`
 */
class m190512_203142_create_regions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%regions}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'id_country' => $this->integer(),
        ]);

        // creates index for column `id_country`
        $this->createIndex(
            '{{%idx-regions-id_country}}',
            '{{%regions}}',
            'id_country'
        );

        // add foreign key for table `{{%countries}}`
        $this->addForeignKey(
            '{{%fk-regions-id_country}}',
            '{{%regions}}',
            'id_country',
            '{{%countries}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%countries}}`
        $this->dropForeignKey(
            '{{%fk-regions-id_country}}',
            '{{%regions}}'
        );

        // drops index for column `id_country`
        $this->dropIndex(
            '{{%idx-regions-id_country}}',
            '{{%regions}}'
        );

        $this->dropTable('{{%regions}}');
    }
}
