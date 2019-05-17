<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%feedback}}`.
 * Has foreign keys to the tables:
 * - `{{%users}}`
 * - `{{%sto}}`
 */
class m190512_203631_create_feedback_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%feedback}}', [
            'id' => $this->primaryKey(),
            'created_by' => $this->integer(),
            'id_sto' => $this->integer(),
            'text' => $this->text(),
            'created_at' => $this->integer(),
            'work_evaluation' => $this->tinyInteger(),
            'cost_evaluation' => $this->tinyInteger(),
            'service_evaluation' => $this->tinyInteger(),
        ]);

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-feedback-created_by}}',
            '{{%feedback}}',
            'created_by'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-feedback-created_by}}',
            '{{%feedback}}',
            'created_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_sto`
        $this->createIndex(
            '{{%idx-feedback-id_sto}}',
            '{{%feedback}}',
            'id_sto'
        );

        // add foreign key for table `{{%sto}}`
        $this->addForeignKey(
            '{{%fk-feedback-id_sto}}',
            '{{%feedback}}',
            'id_sto',
            '{{%sto}}',
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
            '{{%fk-feedback-created_by}}',
            '{{%feedback}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-feedback-created_by}}',
            '{{%feedback}}'
        );

        // drops foreign key for table `{{%sto}}`
        $this->dropForeignKey(
            '{{%fk-feedback-id_sto}}',
            '{{%feedback}}'
        );

        // drops index for column `id_sto`
        $this->dropIndex(
            '{{%idx-feedback-id_sto}}',
            '{{%feedback}}'
        );

        $this->dropTable('{{%feedback}}');
    }
}
