<?php

namespace app\models;

use app\models\query\WorkCategoriesQuery;
use Yii;
use yii\db\ActiveQuery;

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

    /** Fond work category by id
     * @param $id
     *
     * @return WorkCategories|null
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
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
            [['id_work_type'], 'exist', 'skipOnError' => true, 'targetClass' => WorkTypes::class, 'targetAttribute' => ['id_work_type' => 'id']],
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
     * @return ActiveQuery
     */
    public function getBaskets()
    {
        return $this->hasMany(Basket::class, ['id_work_category' => 'id']);
    }

    /**
     * @return ActiveQuery
     */
    public function getWorkType()
    {
        return $this->hasOne(WorkTypes::class, ['id' => 'id_work_type']);
    }

    /**
     * @return ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Works::class, ['id_work_category' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return WorkCategoriesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new WorkCategoriesQuery(get_called_class());
    }
}
