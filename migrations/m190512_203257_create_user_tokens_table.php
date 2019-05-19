<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%user_tokens}}`.
 * Has foreign keys to the tables:
 * - `{{%users}}`
 */
class m190512_203257_create_user_tokens_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%user_tokens}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'token' => $this->string(),
            'expire_time' => $this->integer(),
        ]);

        // creates index for column `id_user`
        $this->createIndex(
            '{{%idx-user_tokens-id_user}}',
            '{{%user_tokens}}',
            'id_user'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-user_tokens-id_user}}',
            '{{%user_tokens}}',
            'id_user',
            '{{%users}}',
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
            '{{%fk-user_tokens-id_user}}',
            '{{%user_tokens}}'
        );

        // drops index for column `id_user`
        $this->dropIndex(
            '{{%idx-user_tokens-id_user}}',
            '{{%user_tokens}}'
        );

        $this->dropTable('{{%user_tokens}}');
    }
}
