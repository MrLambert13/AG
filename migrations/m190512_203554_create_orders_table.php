<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders}}`.
 * Has foreign keys to the tables:
 * - `{{%cities}}`
 * - `{{%vehicles}}`
 * - `{{%users}}`
 * - `{{%users}}`
 * - `{{%request_statuses}}`
 */
class m190512_203554_create_orders_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders}}', [
            'id' => $this->primaryKey(),
            'id_city' => $this->integer()->notNull(),
            'id_vehicle' => $this->integer()->notNull(),
            'created_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->integer()->notNull(),
            'id_request_status' => $this->integer()->notNull(),
            'final_cost' => $this->double(),
            'complete_date' => $this->integer(),
        ]);

        // creates index for column `id_city`
        $this->createIndex(
            '{{%idx-orders-id_city}}',
            '{{%orders}}',
            'id_city'
        );

        // add foreign key for table `{{%cities}}`
        $this->addForeignKey(
            '{{%fk-orders-id_city}}',
            '{{%orders}}',
            'id_city',
            '{{%cities}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_vehicle`
        $this->createIndex(
            '{{%idx-orders-id_vehicle}}',
            '{{%orders}}',
            'id_vehicle'
        );

        // add foreign key for table `{{%vehicles}}`
        $this->addForeignKey(
            '{{%fk-orders-id_vehicle}}',
            '{{%orders}}',
            'id_vehicle',
            '{{%vehicles}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-orders-created_by}}',
            '{{%orders}}',
            'created_by'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-orders-created_by}}',
            '{{%orders}}',
            'created_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-orders-updated_by}}',
            '{{%orders}}',
            'updated_by'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-orders-updated_by}}',
            '{{%orders}}',
            'updated_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_request_status`
        $this->createIndex(
            '{{%idx-orders-id_request_status}}',
            '{{%orders}}',
            'id_request_status'
        );

        // add foreign key for table `{{%request_statuses}}`
        $this->addForeignKey(
            '{{%fk-orders-id_request_status}}',
            '{{%orders}}',
            'id_request_status',
            '{{%request_statuses}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%cities}}`
        $this->dropForeignKey(
            '{{%fk-orders-id_city}}',
            '{{%orders}}'
        );

        // drops index for column `id_city`
        $this->dropIndex(
            '{{%idx-orders-id_city}}',
            '{{%orders}}'
        );

        // drops foreign key for table `{{%vehicles}}`
        $this->dropForeignKey(
            '{{%fk-orders-id_vehicle}}',
            '{{%orders}}'
        );

        // drops index for column `id_vehicle`
        $this->dropIndex(
            '{{%idx-orders-id_vehicle}}',
            '{{%orders}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-orders-created_by}}',
            '{{%orders}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-orders-created_by}}',
            '{{%orders}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-orders-updated_by}}',
            '{{%orders}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-orders-updated_by}}',
            '{{%orders}}'
        );

        // drops foreign key for table `{{%request_statuses}}`
        $this->dropForeignKey(
            '{{%fk-orders-id_request_status}}',
            '{{%orders}}'
        );

        // drops index for column `id_request_status`
        $this->dropIndex(
            '{{%idx-orders-id_request_status}}',
            '{{%orders}}'
        );

        $this->dropTable('{{%orders}}');
    }
}
