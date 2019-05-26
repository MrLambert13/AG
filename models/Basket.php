<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "basket".
 * @property int            $id
 * @property int            $id_service
 * @property int            $id_work_type
 * @property int            $id_work_category
 * @property int            $created_by
 * @property int            $id_vehicle
 * @property int            $create_at
 * @property double         $cost_service
 * @property int            $id_sto
 * @property Users          $createdBy
 * @property ServiceTypes   $service
 * @property Users          $sto
 * @property Vehicles       $vehicle
 * @property WorkCategories $workCategory
 * @property WorkTypes      $workType
 */
class Basket extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'basket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_service', 'id_work_type', 'id_work_category', 'created_by', 'id_vehicle', 'create_at', 'id_sto'], 'integer'],
            [['create_at', 'cost_service'], 'required'],
            [['cost_service'], 'number'],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['id_service'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceTypes::className(), 'targetAttribute' => ['id_service' => 'id']],
            [['id_sto'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_sto' => 'id']],
            [['id_vehicle'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicles::className(), 'targetAttribute' => ['id_vehicle' => 'id']],
            [['id_work_category'], 'exist', 'skipOnError' => true, 'targetClass' => WorkCategories::className(), 'targetAttribute' => ['id_work_category' => 'id']],
            [['id_work_type'], 'exist', 'skipOnError' => true, 'targetClass' => WorkTypes::className(), 'targetAttribute' => ['id_work_type' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_service' => 'Id Service',
            'id_work_type' => 'Id Work Type',
            'id_work_category' => 'Id Work Category',
            'created_by' => 'Created By',
            'id_vehicle' => 'Id Vehicle',
            'create_at' => 'Create At',
            'cost_service' => 'Cost Service',
            'id_sto' => 'Id Sto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(ServiceTypes::className(), ['id' => 'id_service']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSto()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_sto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(Vehicles::className(), ['id' => 'id_vehicle']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkCategory()
    {
        return $this->hasOne(WorkCategories::className(), ['id' => 'id_work_category']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkType()
    {
        return $this->hasOne(WorkTypes::className(), ['id' => 'id_work_type']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\BasketQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\BasketQuery(get_called_class());
    }
}
