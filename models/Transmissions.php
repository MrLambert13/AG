<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "transmissions".
 * @property int        $id
 * @property string     $name
 * @property Vehicles[] $vehicles
 */
class Transmissions extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'transmissions';
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
        return $this->hasMany(Vehicles::className(), ['id_transmission' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\TransmissionsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\TransmissionsQuery(get_called_class());
    }
}
