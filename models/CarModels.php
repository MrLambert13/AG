<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "car_models".
 * @property int        $id
 * @property string     $name
 * @property int        $id_car_brand
 * @property int        $id_car_equip
 * @property int        $year_from
 * @property int        $year_to
 * @property int        $id_car_gen
 * @property int        $id_car_type
 * @property CarBrands  $carBrand
 * @property CarEquips  $carEquip
 * @property CarGens    $carGen
 * @property CarTypes   $carType
 * @property Vehicles[] $vehicles
 */
class CarModels extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_models';
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
            [['name', 'id_car_brand', 'id_car_equip', 'year_from', 'id_car_gen', 'id_car_type'], 'required'],
            [['id_car_brand', 'id_car_equip', 'year_from', 'year_to', 'id_car_gen', 'id_car_type'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id_car_brand'], 'exist', 'skipOnError' => true, 'targetClass' => CarBrands::class, 'targetAttribute' => ['id_car_brand' => 'id']],
            [['id_car_equip'], 'exist', 'skipOnError' => true, 'targetClass' => CarEquips::class, 'targetAttribute' => ['id_car_equip' => 'id']],
            [['id_car_gen'], 'exist', 'skipOnError' => true, 'targetClass' => CarGens::class, 'targetAttribute' => ['id_car_gen' => 'id']],
            [['id_car_type'], 'exist', 'skipOnError' => true, 'targetClass' => CarTypes::class, 'targetAttribute' => ['id_car_type' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'id_car_brand' => 'Id Car Brand',
            'id_car_equip' => 'Id Car Equip',
            'year_from' => 'Year From',
            'year_to' => 'Year To',
            'id_car_gen' => 'Id Car Gen',
            'id_car_type' => 'Id Car Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarBrand()
    {
        return $this->hasOne(CarBrands::className(), ['id' => 'id_car_brand']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarEquip()
    {
        return $this->hasOne(CarEquips::className(), ['id' => 'id_car_equip']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarGen()
    {
        return $this->hasOne(CarGens::className(), ['id' => 'id_car_gen']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarType()
    {
        return $this->hasOne(CarTypes::className(), ['id' => 'id_car_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicles()
    {
        return $this->hasMany(Vehicles::className(), ['id_car_model' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\CarModelsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CarModelsQuery(get_called_class());
    }
}
