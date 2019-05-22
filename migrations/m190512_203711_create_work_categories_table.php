<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%work_categories}}`.
 * Has foreign keys to the tables:
 * - `{{%work_types}}`
 */
class m190512_203711_create_work_categories_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%work_categories}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'cost' => $this->double()->notNull(),
            'id_work_type' => $this->integer(),
        ]);

        // creates index for column `id_work_type`
        $this->createIndex(
            '{{%idx-work_categories-id_work_type}}',
            '{{%work_categories}}',
            'id_work_type'
        );

        // add foreign key for table `{{%work_types}}`
        $this->addForeignKey(
            '{{%fk-work_categories-id_work_type}}',
            '{{%work_categories}}',
            'id_work_type',
            '{{%work_types}}',
            'id',
            'NO ACTION'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%work_types}}`
        $this->dropForeignKey(
            '{{%fk-work_categories-id_work_type}}',
            '{{%work_categories}}'
        );

        // drops index for column `id_work_type`
        $this->dropIndex(
            '{{%idx-work_categories-id_work_type}}',
            '{{%work_categories}}'
        );

        $this->dropTable('{{%work_categories}}');
    }
}
