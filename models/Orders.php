<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $id_city
 * @property int $id_vehicle
 * @property int $created_by
 * @property int $created_at
 * @property int $updated_by
 * @property int $updated_at
 * @property int $id_request_status
 * @property double $final_cost
 * @property int $complete_date
 *
 * @property Users $createdBy
 * @property Cities $city
 * @property RequestStatuses $requestStatus
 * @property Vehicles $vehicle
 * @property Users $updatedBy
 * @property OrdersWorks[] $ordersWorks
 * @property Sto[] $stos
 */
class Orders extends \yii\db\ActiveRecord
{
    const STATUSES = [
        RequestStatuses::STATUS_CREATE,
        RequestStatuses::STATUS_IN_WORK,
        RequestStatuses::STATUS_HALT,
        RequestStatuses::STATUS_DONE,
    ];
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_city', 'id_vehicle', 'id_request_status'], 'required'],
            [['id_city', 'id_vehicle', 'created_by', 'created_at', 'updated_by', 'updated_at', 'id_request_status', 'complete_date'], 'integer'],
            [['final_cost'], 'number', 'min' => 0],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['created_by' => 'id']],
            [['id_city'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::class, 'targetAttribute' => ['id_city' => 'id']],
            ['id_request_status', 'default', 'value' => RequestStatuses::STATUS_CREATE],
            ['id_request_status', 'in', 'range' => self::STATUSES],
            [['id_vehicle'], 'exist', 'skipOnError' => true, 'targetClass' => Vehicles::class, 'targetAttribute' => ['id_vehicle' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_city' => 'Id City',
            'id_vehicle' => 'Id Vehicle',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_by' => 'Updated By',
            'updated_at' => 'Updated At',
            'id_request_status' => 'Id Request Status',
            'final_cost' => 'Final Cost',
            'complete_date' => 'Complete Date',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::class, ['id' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRequestStatus()
    {
        return $this->hasOne(RequestStatuses::className(), ['id' => 'id_request_status']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVehicle()
    {
        return $this->hasOne(Vehicles::className(), ['id' => 'id_vehicle']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(Users::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrdersWorks()
    {
        return $this->hasMany(OrdersWorks::className(), ['id_order' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getStos()
    {
        return $this->hasMany(Sto::className(), ['id_order' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\OrdersQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\OrdersQuery(get_called_class());
    }
}
