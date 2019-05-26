<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "motors".
 * @property int        $id
 * @property string     $name
 * @property Vehicles[] $vehicles
 */
class Motors extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'motors';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'string'],
        ];
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
    public function getVehicles()
    {
        return $this->hasMany(Vehicles::class, ['id_motor' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\MotorsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\MotorsQuery(get_called_class());
    }
}
