<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_types".
 * @property int         $id
 * @property string      $name
 * @property int         $id_sto
 * @property Basket[]    $baskets
 * @property Users       $sto
 * @property WorkTypes[] $workTypes
 * @property Works[]     $works
 */
class ServiceTypes extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_sto'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id_sto'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_sto' => 'id']],
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
            'id_sto' => 'Id Sto',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaskets()
    {
        return $this->hasMany(Basket::className(), ['id_service' => 'id']);
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
    public function getWorkTypes()
    {
        return $this->hasMany(WorkTypes::className(), ['id_service_type' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Works::className(), ['id_service' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\ServiceTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\ServiceTypesQuery(get_called_class());
    }
}
