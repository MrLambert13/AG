<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%orders_works}}`.
 * Has foreign keys to the tables:
 * - `{{%orders}}`
 * - `{{%works}}`
 */
class m190513_052332_create_orders_works_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%orders_works}}', [
            'id' => $this->primaryKey(),
            'id_order' => $this->integer(),
            'id_work' => $this->integer(),
        ]);

        // creates index for column `id_order`
        $this->createIndex(
            '{{%idx-orders_works-id_order}}',
            '{{%orders_works}}',
            'id_order'
        );

        // add foreign key for table `{{%orders}}`
        $this->addForeignKey(
            '{{%fk-orders_works-id_order}}',
            '{{%orders_works}}',
            'id_order',
            '{{%orders}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_work`
        $this->createIndex(
            '{{%idx-orders_works-id_work}}',
            '{{%orders_works}}',
            'id_work'
        );

        // add foreign key for table `{{%works}}`
        $this->addForeignKey(
            '{{%fk-orders_works-id_work}}',
            '{{%orders_works}}',
            'id_work',
            '{{%works}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%orders}}`
        $this->dropForeignKey(
            '{{%fk-orders_works-id_order}}',
            '{{%orders_works}}'
        );

        // drops index for column `id_order`
        $this->dropIndex(
            '{{%idx-orders_works-id_order}}',
            '{{%orders_works}}'
        );

        // drops foreign key for table `{{%works}}`
        $this->dropForeignKey(
            '{{%fk-orders_works-id_work}}',
            '{{%orders_works}}'
        );

        // drops index for column `id_work`
        $this->dropIndex(
            '{{%idx-orders_works-id_work}}',
            '{{%orders_works}}'
        );

        $this->dropTable('{{%orders_works}}');
    }
}
