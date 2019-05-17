<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%vip_cards}}`.
 * Has foreign keys to the tables:
 * - `{{%sto}}`
 * - `{{%users}}`
 */
class m190513_052339_create_vip_cards_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%vip_cards}}', [
            'id' => $this->primaryKey(),
            'number' => $this->integer()->notNull(),
            'status' => 'ENUM("use","block")',
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer(),
            'id_sto' => $this->integer(),
            'id_user' => $this->integer(),
        ]);

        // creates index for column `id_sto`
        $this->createIndex(
            '{{%idx-vip_cards-id_sto}}',
            '{{%vip_cards}}',
            'id_sto'
        );

        // add foreign key for table `{{%sto}}`
        $this->addForeignKey(
            '{{%fk-vip_cards-id_sto}}',
            '{{%vip_cards}}',
            'id_sto',
            '{{%sto}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_user`
        $this->createIndex(
            '{{%idx-vip_cards-id_user}}',
            '{{%vip_cards}}',
            'id_user'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-vip_cards-id_user}}',
            '{{%vip_cards}}',
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
        // drops foreign key for table `{{%sto}}`
        $this->dropForeignKey(
            '{{%fk-vip_cards-id_sto}}',
            '{{%vip_cards}}'
        );

        // drops index for column `id_sto`
        $this->dropIndex(
            '{{%idx-vip_cards-id_sto}}',
            '{{%vip_cards}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-vip_cards-id_user}}',
            '{{%vip_cards}}'
        );

        // drops index for column `id_user`
        $this->dropIndex(
            '{{%idx-vip_cards-id_user}}',
            '{{%vip_cards}}'
        );

        $this->dropTable('{{%vip_cards}}');
    }
}
