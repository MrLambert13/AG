<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%users_info}}`.
 * Has foreign keys to the tables:
 * - `{{%users}}`
 * - `{{%user_types}}`
 * - `{{%cities}}`
 */
class m190512_203247_create_users_info_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%users_info}}', [
            'id' => $this->primaryKey(),
            'id_user' => $this->integer()->notNull(),
            'id_type' => $this->integer(),
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
            'NO ACTION'
        );

        // creates index for column `id_type`
        $this->createIndex(
            '{{%idx-users_info-id_type}}',
            '{{%users_info}}',
            'id_type'
        );

        // add foreign key for table `{{%user_types}}`
        $this->addForeignKey(
            '{{%fk-users_info-id_type}}',
            '{{%users_info}}',
            'id_type',
            '{{%user_types}}',
            'id',
            'NO ACTION'
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
            'NO ACTION'
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

        // drops foreign key for table `{{%user_types}}`
        $this->dropForeignKey(
            '{{%fk-users_info-id_type}}',
            '{{%users_info}}'
        );

        // drops index for column `id_type`
        $this->dropIndex(
            '{{%idx-users_info-id_type}}',
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
