<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%car_models}}`.
 * Has foreign keys to the tables:
 * - `{{%car_brands}}`
 * - `{{%car_equips}}`
 * - `{{%car_gens}}`
 * - `{{%car_types}}`
 */
class m190512_203458_create_car_models_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%car_models}}', [
            'id' => $this->primaryKey(),
            'name' => $this->string()->notNull(),
            'id_car_brand' => $this->integer()->notNull(),
            'id_car_equip' => $this->integer()->notNull(),
            'year_from' => $this->integer()->notNull(),
            'year_to' => $this->integer(),
            'id_car_gen' => $this->integer()->notNull(),
            'id_car_type' => $this->integer()->notNull(),
        ]);

        // creates index for column `id_car_brand`
        $this->createIndex(
            '{{%idx-car_models-id_car_brand}}',
            '{{%car_models}}',
            'id_car_brand'
        );

        // add foreign key for table `{{%car_brands}}`
        $this->addForeignKey(
            '{{%fk-car_models-id_car_brand}}',
            '{{%car_models}}',
            'id_car_brand',
            '{{%car_brands}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_car_equip`
        $this->createIndex(
            '{{%idx-car_models-id_car_equip}}',
            '{{%car_models}}',
            'id_car_equip'
        );

        // add foreign key for table `{{%car_equips}}`
        $this->addForeignKey(
            '{{%fk-car_models-id_car_equip}}',
            '{{%car_models}}',
            'id_car_equip',
            '{{%car_equips}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_car_gen`
        $this->createIndex(
            '{{%idx-car_models-id_car_gen}}',
            '{{%car_models}}',
            'id_car_gen'
        );

        // add foreign key for table `{{%car_gens}}`
        $this->addForeignKey(
            '{{%fk-car_models-id_car_gen}}',
            '{{%car_models}}',
            'id_car_gen',
            '{{%car_gens}}',
            'id',
            'CASCADE'
        );

        // creates index for column `id_car_type`
        $this->createIndex(
            '{{%idx-car_models-id_car_type}}',
            '{{%car_models}}',
            'id_car_type'
        );

        // add foreign key for table `{{%car_types}}`
        $this->addForeignKey(
            '{{%fk-car_models-id_car_type}}',
            '{{%car_models}}',
            'id_car_type',
            '{{%car_types}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%car_brands}}`
        $this->dropForeignKey(
            '{{%fk-car_models-id_car_brand}}',
            '{{%car_models}}'
        );

        // drops index for column `id_car_brand`
        $this->dropIndex(
            '{{%idx-car_models-id_car_brand}}',
            '{{%car_models}}'
        );

        // drops foreign key for table `{{%car_equips}}`
        $this->dropForeignKey(
            '{{%fk-car_models-id_car_equip}}',
            '{{%car_models}}'
        );

        // drops index for column `id_car_equip`
        $this->dropIndex(
            '{{%idx-car_models-id_car_equip}}',
            '{{%car_models}}'
        );

        // drops foreign key for table `{{%car_gens}}`
        $this->dropForeignKey(
            '{{%fk-car_models-id_car_gen}}',
            '{{%car_models}}'
        );

        // drops index for column `id_car_gen`
        $this->dropIndex(
            '{{%idx-car_models-id_car_gen}}',
            '{{%car_models}}'
        );

        // drops foreign key for table `{{%car_types}}`
        $this->dropForeignKey(
            '{{%fk-car_models-id_car_type}}',
            '{{%car_models}}'
        );

        // drops index for column `id_car_type`
        $this->dropIndex(
            '{{%idx-car_models-id_car_type}}',
            '{{%car_models}}'
        );

        $this->dropTable('{{%car_models}}');
    }
}
