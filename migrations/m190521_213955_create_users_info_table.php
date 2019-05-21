<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_info}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%users}}`
 * - `{{%cities}}`
 */
class m190521_213955_create_users_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users_info}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'surname' => $this->string()->notNull(),
            'name' => $this->string()->notNull(),
            'middlename' => $this->string(),
            'birthday' => $this->integer()->notNull(),
            'telegram_name' => $this->string(),
            'telephone' => $this->string(10)->notNull()->unique(),
            'id_city' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_user`
        $this->createIndex(
            '{{%idx-users_info-id_user}}',
            '{{%users_info}}',
            'id_user'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-users_info-id_user}}',
            '{{%users_info}}',
            'id_user',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_city`
        $this->createIndex(
            '{{%idx-users_info-id_city}}',
            '{{%users_info}}',
            'id_city'
        );

        // add foreign key for table `{{%cities}}`
        $this->addForeignKey(
            '{{%fk-users_info-id_city}}',
            '{{%users_info}}',
            'id_city',
            '{{%cities}}',
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
            '{{%fk-users_info-id_user}}',
            '{{%users_info}}'
        );

        // drops index for column `id_user`
        $this->dropIndex(
            '{{%idx-users_info-id_user}}',
            '{{%users_info}}'
        );

        // drops foreign key for table `{{%cities}}`
        $this->dropForeignKey(
            '{{%fk-users_info-id_city}}',
            '{{%users_info}}'
        );

        // drops index for column `id_city`
        $this->dropIndex(
            '{{%idx-users_info-id_city}}',
            '{{%users_info}}'
        );

        $this->dropTable('{{%users_info}}');
    }
}
