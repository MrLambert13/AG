<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%sto}}`.
 * Has foreign keys to the tables:
 * - `{{%orders}}`
 */
class m190512_203619_create_sto_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%sto}}', [
            'id' => $this->primaryKey(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'username' => $this->string(32)->notNull()->unique(),
            'name' => $this->string()->notNull(),
            'geo' => $this->string(),
            'rate' => $this->integer(),
            'id_order' => $this->integer(),
            'address' => $this->string(),
            'telephone' => $this->string(10)->notNull()->unique(),
            'email' => $this->string()->unique(),
        ]);

        // creates index for column `id_order`
        $this->createIndex(
            '{{%idx-sto-id_order}}',
            '{{%sto}}',
            'id_order'
        );

        // add foreign key for table `{{%orders}}`
        $this->addForeignKey(
            '{{%fk-sto-id_order}}',
            '{{%sto}}',
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
        // drops foreign key for table `{{%orders}}`
        $this->dropForeignKey(
            '{{%fk-sto-id_order}}',
            '{{%sto}}'
        );

        // drops index for column `id_order`
        $this->dropIndex(
            '{{%idx-sto-id_order}}',
            '{{%sto}}'
        );

        $this->dropTable('{{%sto}}');
    }
}
