<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%bonuses}}`.
 * Has foreign keys to the tables:
 * - `{{%vip_cards}}`
 */
class m190513_052343_create_bonuses_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%bonuses}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'size' => $this->double()->notNull(),
            'used_count' => $this->integer(),
            'max_count' => $this->integer(),
            'id_vip_card' => $this->integer(),
        ]);

        // creates index for column `id_vip_card`
        $this->createIndex(
            '{{%idx-bonuses-id_vip_card}}',
            '{{%bonuses}}',
            'id_vip_card'
        );

        // add foreign key for table `{{%vip_cards}}`
        $this->addForeignKey(
            '{{%fk-bonuses-id_vip_card}}',
            '{{%bonuses}}',
            'id_vip_card',
            '{{%vip_cards}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%vip_cards}}`
        $this->dropForeignKey(
            '{{%fk-bonuses-id_vip_card}}',
            '{{%bonuses}}'
        );

        // drops index for column `id_vip_card`
        $this->dropIndex(
            '{{%idx-bonuses-id_vip_card}}',
            '{{%bonuses}}'
        );

        $this->dropTable('{{%bonuses}}');
    }
}
