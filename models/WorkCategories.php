<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "work_categories".
 * @property int       $id
 * @property string    $name
 * @property double    $cost
 * @property int       $id_work_type
 * @property Basket[]  $baskets
 * @property WorkTypes $workType
 * @property Works[]   $works
 */
class WorkCategories extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'work_categories';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'cost'], 'required'],
            [['cost'], 'number'],
            [['id_work_type'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id_work_type'], 'exist', 'skipOnError' => true, 'targetClass' => WorkTypes::className(), 'targetAttribute' => ['id_work_type' => 'id']],
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
            'cost' => 'Cost',
            'id_work_type' => 'Id Work Type',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaskets()
    {
        return $this->hasMany(Basket::className(), ['id_work_category' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorkType()
    {
        return $this->hasOne(WorkTypes::className(), ['id' => 'id_work_type']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Works::className(), ['id_work_category' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\WorkCategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\WorkCategoriesQuery(get_called_class());
    }
}
