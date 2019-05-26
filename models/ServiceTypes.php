<?php

namespace app\models;

use app\models\query\ServiceTypesQuery;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

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
class ServiceTypes extends ActiveRecord
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
     * Find service by id
     * @param $id
     *
     * @return ServiceTypes|null
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * @return ActiveQuery
     */
    public function getBaskets()
    {
        return $this->hasMany(Basket::class, ['id_service' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getSto()
    {
        return $this->hasOne(Users::class, ['id' => 'id_sto']);
    }

    /**
     * @return ActiveQuery
     */
    public function getWorkTypes()
    {
        return $this->hasMany(WorkTypes::class, ['id_service_type' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Works::class, ['id_service' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ServiceTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ServiceTypesQuery(get_called_class());
    }
}
