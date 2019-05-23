<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "vehicles".
 * @property int           $id
 * @property int           $id_car_model
 * @property int           $id_motor
 * @property int           $power
 * @property string        $vin
 * @property string        $reg_number
 * @property int           $rel_year
 * @property int           $id_transmission
 * @property int           $mileage
 * @property int           $created_by
 * @property int           $created_at
 * @property int           $updated_by
 * @property int           $updated_at
 * @property Basket[]      $baskets
 * @property Garages[]     $garages
 * @property Orders[]      $orders
 * @property Users         $createdBy
 * @property CarModels     $carModel
 * @property Motors        $motor
 * @property Transmissions $transmission
 * @property Users         $updatedBy
 * @property Works[]       $works
 */
class Vehicles extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vehicles';
    }

    public function behaviors()
    {
        return [
            ['class' => TimestampBehavior::class],
        ];
    }


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_car_model', 'id_motor', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'required'],
            [['id_car_model', 'id_motor', 'power', 'rel_year', 'id_transmission', 'mileage', 'created_by', 'created_at', 'updated_by', 'updated_at'], 'integer'],
            [['vin'], 'string', 'max' => 17],
            [['reg_number'], 'string', 'max' => 7],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['id_car_model'], 'exist', 'skipOnError' => true, 'targetClass' => CarModels::className(), 'targetAttribute' => ['id_car_model' => 'id']],
            [['id_motor'], 'exist', 'skipOnError' => true, 'targetClass' => Motors::className(), 'targetAttribute' => ['id_motor' => 'id']],
            [['id_transmission'], 'exist', 'skipOnError' => true, 'targetClass' => Transmissions::className(), 'targetAttribute' => ['id_transmission' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_car_model' => 'Id Car Model',
            'id_motor' => 'Id Motor',
            'power' => 'Power',
            'vin' => 'Vin',
            'reg_number' => 'Reg Number',
            'rel_year' => 'Rel Year',
            'id_transmission' => 'Id Transmission',
            'mileage' => 'Mileage',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaskets()
    {
        return $this->hasMany(Basket::className(), ['id_vehicle' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGarages()
    {
        return $this->hasMany(Garages::className(), ['id_vehicle' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['id_vehicle' => 'id']);
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
    public function getCarModel()
    {
        return $this->hasOne(CarModels::className(), ['id' => 'id_car_model']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMotor()
    {
        return $this->hasOne(Motors::className(), ['id' => 'id_motor']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTransmission()
    {
        return $this->hasOne(Transmissions::className(), ['id' => 'id_transmission']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Works::className(), ['id_vehicle' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\VehiclesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\VehiclesQuery(get_called_class());
    }
}
