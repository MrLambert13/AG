<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%works}}`.
 * Has foreign keys to the tables:
 * - `{{%service_types}}`
 * - `{{%work_types}}`
 * - `{{%work_categories}}`
 * - `{{%users}}`
 * - `{{%vehicles}}`
 * - `{{%request_statuses}}`
 * - `{{%sto}}`
 */
class m190513_052324_create_works_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%works}}', [
            'id' => $this->primaryKey(),
            'id_service' => $this->integer(),
            'id_work_type' => $this->integer(),
            'id_work_category' => $this->integer(),
            'created_by' => $this->integer(),
            'id_vehicle' => $this->integer(),
            'create_at' => $this->integer()->notNull(),
            'cost_service' => $this->double()->notNull(),
            'date_start' => $this->integer(),
            'date_end' => $this->integer(),
            'status' => $this->integer(),
            'id_sto' => $this->integer(),
        ]);

        // creates index for column `id_service`
        $this->createIndex(
            '{{%idx-works-id_service}}',
            '{{%works}}',
            'id_service'
        );

        // add foreign key for table `{{%service_types}}`
        $this->addForeignKey(
            '{{%fk-works-id_service}}',
            '{{%works}}',
            'id_service',
            '{{%service_types}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_work_type`
        $this->createIndex(
            '{{%idx-works-id_work_type}}',
            '{{%works}}',
            'id_work_type'
        );

        // add foreign key for table `{{%work_types}}`
        $this->addForeignKey(
            '{{%fk-works-id_work_type}}',
            '{{%works}}',
            'id_work_type',
            '{{%work_types}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_work_category`
        $this->createIndex(
            '{{%idx-works-id_work_category}}',
            '{{%works}}',
            'id_work_category'
        );

        // add foreign key for table `{{%work_categories}}`
        $this->addForeignKey(
            '{{%fk-works-id_work_category}}',
            '{{%works}}',
            'id_work_category',
            '{{%work_categories}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-works-created_by}}',
            '{{%works}}',
            'created_by'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-works-created_by}}',
            '{{%works}}',
            'created_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_vehicle`
        $this->createIndex(
            '{{%idx-works-id_vehicle}}',
            '{{%works}}',
            'id_vehicle'
        );

        // add foreign key for table `{{%vehicles}}`
        $this->addForeignKey(
            '{{%fk-works-id_vehicle}}',
            '{{%works}}',
            'id_vehicle',
            '{{%vehicles}}',
            'id',
            'CASCADE'
        );

        // creates index for column `status`
        $this->createIndex(
            '{{%idx-works-status}}',
            '{{%works}}',
            'status'
        );

        // add foreign key for table `{{%request_statuses}}`
        $this->addForeignKey(
            '{{%fk-works-status}}',
            '{{%works}}',
            'status',
            '{{%request_statuses}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_sto`
        $this->createIndex(
            '{{%idx-works-id_sto}}',
            '{{%works}}',
            'id_sto'
        );

        // add foreign key for table `{{%sto}}`
        $this->addForeignKey(
            '{{%fk-works-id_sto}}',
            '{{%works}}',
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
            '{{%fk-works-id_service}}',
            '{{%works}}'
        );

        // drops index for column `id_service`
        $this->dropIndex(
            '{{%idx-works-id_service}}',
            '{{%works}}'
        );

        // drops foreign key for table `{{%work_types}}`
        $this->dropForeignKey(
            '{{%fk-works-id_work_type}}',
            '{{%works}}'
        );

        // drops index for column `id_work_type`
        $this->dropIndex(
            '{{%idx-works-id_work_type}}',
            '{{%works}}'
        );

        // drops foreign key for table `{{%work_categories}}`
        $this->dropForeignKey(
            '{{%fk-works-id_work_category}}',
            '{{%works}}'
        );

        // drops index for column `id_work_category`
        $this->dropIndex(
            '{{%idx-works-id_work_category}}',
            '{{%works}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-works-created_by}}',
            '{{%works}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-works-created_by}}',
            '{{%works}}'
        );

        // drops foreign key for table `{{%vehicles}}`
        $this->dropForeignKey(
            '{{%fk-works-id_vehicle}}',
            '{{%works}}'
        );

        // drops index for column `id_vehicle`
        $this->dropIndex(
            '{{%idx-works-id_vehicle}}',
            '{{%works}}'
        );

        // drops foreign key for table `{{%request_statuses}}`
        $this->dropForeignKey(
            '{{%fk-works-status}}',
            '{{%works}}'
        );

        // drops index for column `status`
        $this->dropIndex(
            '{{%idx-works-status}}',
            '{{%works}}'
        );

        // drops foreign key for table `{{%sto}}`
        $this->dropForeignKey(
            '{{%fk-works-id_sto}}',
            '{{%works}}'
        );

        // drops index for column `id_sto`
        $this->dropIndex(
            '{{%idx-works-id_sto}}',
            '{{%works}}'
        );

        $this->dropTable('{{%works}}');
    }
}
