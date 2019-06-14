<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "request_statuses".
 *
 * @property int $id
 * @property string $name
 *
 * @property Orders[] $orders
 * @property Works[] $works
 */
class RequestStatuses extends \yii\db\ActiveRecord
{
    const STATUS_CREATE = 1;
    const STATUS_IN_WORK = 2;
    const STATUS_HALT = 3;
    const STATUS_DONE = 4;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'request_statuses';
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
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['id_request_status' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Works::className(), ['status' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\RequestStatusesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\RequestStatusesQuery(get_called_class());
    }
}
