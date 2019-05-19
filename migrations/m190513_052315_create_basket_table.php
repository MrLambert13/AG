<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%basket}}`.
 * Has foreign keys to the tables:
 * - `{{%service_types}}`
 * - `{{%work_types}}`
 * - `{{%work_categories}}`
 * - `{{%users}}`
 * - `{{%vehicles}}`
 * - `{{%sto}}`
 */
class m190513_052315_create_basket_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%basket}}', [
            'id' => $this->primaryKey(),
            'id_service' => $this->integer(),
            'id_work_type' => $this->integer(),
            'id_work_category' => $this->integer(),
            'created_by' => $this->integer(),
            'id_vehicle' => $this->integer(),
            'create_at' => $this->integer()->notNull(),
            'cost_service' => $this->double()->notNull(),
            'id_sto' => $this->integer(),
        ]);

        // creates index for column `id_service`
        $this->createIndex(
            '{{%idx-basket-id_service}}',
            '{{%basket}}',
            'id_service'
        );

        // add foreign key for table `{{%service_types}}`
        $this->addForeignKey(
            '{{%fk-basket-id_service}}',
            '{{%basket}}',
            'id_service',
            '{{%service_types}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_work_type`
        $this->createIndex(
            '{{%idx-basket-id_work_type}}',
            '{{%basket}}',
            'id_work_type'
        );

        // add foreign key for table `{{%work_types}}`
        $this->addForeignKey(
            '{{%fk-basket-id_work_type}}',
            '{{%basket}}',
            'id_work_type',
            '{{%work_types}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_work_category`
        $this->createIndex(
            '{{%idx-basket-id_work_category}}',
            '{{%basket}}',
            'id_work_category'
        );

        // add foreign key for table `{{%work_categories}}`
        $this->addForeignKey(
            '{{%fk-basket-id_work_category}}',
            '{{%basket}}',
            'id_work_category',
            '{{%work_categories}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-basket-created_by}}',
            '{{%basket}}',
            'created_by'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-basket-created_by}}',
            '{{%basket}}',
            'created_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_vehicle`
        $this->createIndex(
            '{{%idx-basket-id_vehicle}}',
            '{{%basket}}',
            'id_vehicle'
        );

        // add foreign key for table `{{%vehicles}}`
        $this->addForeignKey(
            '{{%fk-basket-id_vehicle}}',
            '{{%basket}}',
            'id_vehicle',
            '{{%vehicles}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_sto`
        $this->createIndex(
            '{{%idx-basket-id_sto}}',
            '{{%basket}}',
            'id_sto'
        );

        // add foreign key for table `{{%sto}}`
        $this->addForeignKey(
            '{{%fk-basket-id_sto}}',
            '{{%basket}}',
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
            '{{%fk-basket-id_service}}',
            '{{%basket}}'
        );

        // drops index for column `id_service`
        $this->dropIndex(
            '{{%idx-basket-id_service}}',
            '{{%basket}}'
        );

        // drops foreign key for table `{{%work_types}}`
        $this->dropForeignKey(
            '{{%fk-basket-id_work_type}}',
            '{{%basket}}'
        );

        // drops index for column `id_work_type`
        $this->dropIndex(
            '{{%idx-basket-id_work_type}}',
            '{{%basket}}'
        );

        // drops foreign key for table `{{%work_categories}}`
        $this->dropForeignKey(
            '{{%fk-basket-id_work_category}}',
            '{{%basket}}'
        );

        // drops index for column `id_work_category`
        $this->dropIndex(
            '{{%idx-basket-id_work_category}}',
            '{{%basket}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-basket-created_by}}',
            '{{%basket}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-basket-created_by}}',
            '{{%basket}}'
        );

        // drops foreign key for table `{{%vehicles}}`
        $this->dropForeignKey(
            '{{%fk-basket-id_vehicle}}',
            '{{%basket}}'
        );

        // drops index for column `id_vehicle`
        $this->dropIndex(
            '{{%idx-basket-id_vehicle}}',
            '{{%basket}}'
        );

        // drops foreign key for table `{{%sto}}`
        $this->dropForeignKey(
            '{{%fk-basket-id_sto}}',
            '{{%basket}}'
        );

        // drops index for column `id_sto`
        $this->dropIndex(
            '{{%idx-basket-id_sto}}',
            '{{%basket}}'
        );

        $this->dropTable('{{%basket}}');
    }
}
