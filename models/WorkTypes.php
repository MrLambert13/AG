<?php

namespace app\models;

use app\models\query\WorkTypesQuery;
use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "work_types".
 * @property int              $id
 * @property string           $name
 * @property int              $id_service_type
 * @property Basket[]         $baskets
 * @property WorkCategories[] $workCategories
 * @property ServiceTypes     $serviceType
 * @property Works[]          $works
 */
class WorkTypes extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_types';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['id_service_type'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id_service_type'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceTypes::class, 'targetAttribute' => ['id_service_type' => 'id']],
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
            'id_service_type' => 'Id Service Type',
        ];
    }

    /**
     * Find Work types by id
     * @param $id
     *
     * @return WorkTypes|null
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
        return $this->hasMany(Basket::class, ['id_work_type' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getWorkCategories()
    {
        return $this->hasMany(WorkCategories::class, ['id_work_type' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getServiceType()
    {
        return $this->hasOne(ServiceTypes::class, ['id' => 'id_service_type']);
    }

    /**
     * @return ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Works::class, ['id_work_type' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return WorkTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WorkTypesQuery(get_called_class());
    }
}
