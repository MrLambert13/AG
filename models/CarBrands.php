<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "car_brands".
 * @property int         $id
 * @property string      $name
 * @property CarModels[] $carModels
 */
class CarBrands extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_brands';
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
            [['name'], 'required'],
            [['name'], 'string', 'max' => 255],
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
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCarModels()
    {
        return $this->hasMany(CarModels::className(), ['id_car_brand' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\CarBrandsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\CarBrandsQuery(get_called_class());
    }
}
