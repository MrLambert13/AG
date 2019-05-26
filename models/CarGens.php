<?php

namespace app\models;

use app\models\query\CarGensQuery;
use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "car_gens".
 * @property int         $id
 * @property string      $name
 * @property CarModels[] $carModels
 */
class CarGens extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'car_gens';
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
        return $this->hasMany(CarModels::class, ['id_car_gen' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\CarGensQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CarGensQuery(get_called_class());
    }
}
