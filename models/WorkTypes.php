<?php

namespace app\models;

use Yii;

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
class WorkTypes extends \yii\db\ActiveRecord
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
            [['id_service_type'], 'exist', 'skipOnError' => true, 'targetClass' => ServiceTypes::className(), 'targetAttribute' => ['id_service_type' => 'id']],
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
     * @return \yii\db\ActiveQuery
     */
    public function getBaskets()
    {
        return $this->hasMany(Basket::className(), ['id_work_type' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkCategories()
    {
        return $this->hasMany(WorkCategories::className(), ['id_work_type' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceType()
    {
        return $this->hasOne(ServiceTypes::className(), ['id' => 'id_service_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Works::className(), ['id_work_type' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\WorkTypesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\WorkTypesQuery(get_called_class());
    }
}
