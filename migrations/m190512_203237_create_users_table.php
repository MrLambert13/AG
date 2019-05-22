<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user_types}}`
 */
class m190512_203237_create_users_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users}}', [
            'id' => $this->primaryKey(),
            'password_hash' => $this->string()->notNull(),
            'auth_key' => $this->string(),
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'username' => $this->string(32)->notNull()->unique(),
            'email' => $this->string(128)->notNull()->unique(),
            'status' => $this->boolean(),
            'id_user_type' => $this->integer(),
        ]);

        // creates index for column `id_user_type`
        $this->createIndex(
            '{{%idx-users-id_user_type}}',
            '{{%users}}',
            'id_user_type'
        );

        // add foreign key for table `{{%user_types}}`
        $this->addForeignKey(
            '{{%fk-users-id_user_type}}',
            '{{%users}}',
            'id_user_type',
            '{{%user_types}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%user_types}}`
        $this->dropForeignKey(
            '{{%fk-users-id_user_type}}',
            '{{%users}}'
        );

        // drops index for column `id_user_type`
        $this->dropIndex(
            '{{%idx-users-id_user_type}}',
            '{{%users}}'
        );

        $this->dropTable('{{%users}}');
    }
}
