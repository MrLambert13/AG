<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%service_types}}`.
 * Has foreign keys to the tables:
 * - `{{%sto}}`
 */
class m190512_203640_create_service_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%service_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->integer()->notNull(),
            'id_sto' => $this->integer(),
        ]);

        // creates index for column `id_sto`
        $this->createIndex(
            '{{%idx-service_types-id_sto}}',
            '{{%service_types}}',
            'id_sto'
        );

        // add foreign key for table `{{%sto}}`
        $this->addForeignKey(
            '{{%fk-service_types-id_sto}}',
            '{{%service_types}}',
            'id_sto',
            '{{%sto}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%sto}}`
        $this->dropForeignKey(
            '{{%fk-service_types-id_sto}}',
            '{{%service_types}}'
        );

        // drops index for column `id_sto`
        $this->dropIndex(
            '{{%idx-service_types-id_sto}}',
            '{{%service_types}}'
        );

        $this->dropTable('{{%service_types}}');
    }
}
