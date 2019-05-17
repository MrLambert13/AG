<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%garages}}`.
 * Has foreign keys to the tables:
 * - `{{%vehicles}}`
 * - `{{%users}}`
 * - `{{%users}}`
 */
class m190512_203605_create_garages_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%garages}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'id_vehicle' => $this->integer(),
            'created_by' => $this->integer()->notNull(),
            'created_at' => $this->integer()->notNull(),
            'updated_by' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        // creates index for column `id_vehicle`
        $this->createIndex(
            '{{%idx-garages-id_vehicle}}',
            '{{%garages}}',
            'id_vehicle'
        );

        // add foreign key for table `{{%vehicles}}`
        $this->addForeignKey(
            '{{%fk-garages-id_vehicle}}',
            '{{%garages}}',
            'id_vehicle',
            '{{%vehicles}}',
            'id',
            'CASCADE'
        );

        // creates index for column `created_by`
        $this->createIndex(
            '{{%idx-garages-created_by}}',
            '{{%garages}}',
            'created_by'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-garages-created_by}}',
            '{{%garages}}',
            'created_by',
            '{{%users}}',
            'id',
            'CASCADE'
        );

        // creates index for column `updated_by`
        $this->createIndex(
            '{{%idx-garages-updated_by}}',
            '{{%garages}}',
            'updated_by'
        );

        // add foreign key for table `{{%users}}`
        $this->addForeignKey(
            '{{%fk-garages-updated_by}}',
            '{{%garages}}',
            'updated_by',
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
        // drops foreign key for table `{{%vehicles}}`
        $this->dropForeignKey(
            '{{%fk-garages-id_vehicle}}',
            '{{%garages}}'
        );

        // drops index for column `id_vehicle`
        $this->dropIndex(
            '{{%idx-garages-id_vehicle}}',
            '{{%garages}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-garages-created_by}}',
            '{{%garages}}'
        );

        // drops index for column `created_by`
        $this->dropIndex(
            '{{%idx-garages-created_by}}',
            '{{%garages}}'
        );

        // drops foreign key for table `{{%users}}`
        $this->dropForeignKey(
            '{{%fk-garages-updated_by}}',
            '{{%garages}}'
        );

        // drops index for column `updated_by`
        $this->dropIndex(
            '{{%idx-garages-updated_by}}',
            '{{%garages}}'
        );

        $this->dropTable('{{%garages}}');
    }
}
