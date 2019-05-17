<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_types}}`.
 * Has foreign keys to the tables:
 * - `{{%service_types}}`
 * - `{{%sto}}`
 */
class m190512_203648_create_work_types_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_types}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'id_service_type' => $this->integer(),
            'id_sto' => $this->integer(),
        ]);

        // creates index for column `id_service_type`
        $this->createIndex(
            '{{%idx-work_types-id_service_type}}',
            '{{%work_types}}',
            'id_service_type'
        );

        // add foreign key for table `{{%service_types}}`
        $this->addForeignKey(
            '{{%fk-work_types-id_service_type}}',
            '{{%work_types}}',
            'id_service_type',
            '{{%service_types}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_sto`
        $this->createIndex(
            '{{%idx-work_types-id_sto}}',
            '{{%work_types}}',
            'id_sto'
        );

        // add foreign key for table `{{%sto}}`
        $this->addForeignKey(
            '{{%fk-work_types-id_sto}}',
            '{{%work_types}}',
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
        // drops foreign key for table `{{%service_types}}`
        $this->dropForeignKey(
            '{{%fk-work_types-id_service_type}}',
            '{{%work_types}}'
        );

        // drops index for column `id_service_type`
        $this->dropIndex(
            '{{%idx-work_types-id_service_type}}',
            '{{%work_types}}'
        );

        // drops foreign key for table `{{%sto}}`
        $this->dropForeignKey(
            '{{%fk-work_types-id_sto}}',
            '{{%work_types}}'
        );

        // drops index for column `id_sto`
        $this->dropIndex(
            '{{%idx-work_types-id_sto}}',
            '{{%work_types}}'
        );

        $this->dropTable('{{%work_types}}');
    }
}
