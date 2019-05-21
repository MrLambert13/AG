<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sto_info}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 * - `{{%orders}}`
 */
class m190512_203619_create_sto_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sto_info}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'geo' => $this->string(),
            'rate' => $this->integer(),
            'id_order' => $this->integer(),
            'address' => $this->string(),
            'telephone' => $this->string(10)->notNull()->unique(),
        ]);

        // creates index for column `id_user`
        $this->createIndex(
            '{{%idx-sto_info-id_user}}',
            '{{%sto_info}}',
            'id_user'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-sto_info-id_user}}',
            '{{%sto_info}}',
            'id_user',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_order`
        $this->createIndex(
            '{{%idx-sto_info-id_order}}',
            '{{%sto_info}}',
            'id_order'
        );

        // add foreign key for table `{{%orders}}`
        $this->addForeignKey(
            '{{%fk-sto_info-id_order}}',
            '{{%sto_info}}',
            'id_order',
            '{{%orders}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-sto_info-id_user}}',
            '{{%sto_info}}'
        );

        // drops index for column `id_user`
        $this->dropIndex(
            '{{%idx-sto_info-id_user}}',
            '{{%sto_info}}'
        );

        // drops foreign key for table `{{%orders}}`
        $this->dropForeignKey(
            '{{%fk-sto_info-id_order}}',
            '{{%sto_info}}'
        );

        // drops index for column `id_order`
        $this->dropIndex(
            '{{%idx-sto_info-id_order}}',
            '{{%sto_info}}'
        );

        $this->dropTable('{{%sto_info}}');
    }
}
