<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders_works".
 *
 * @property int $id
 * @property int $id_order
 * @property int $id_work
 *
 * @property Orders $order
 * @property Works $work
 */
class OrdersWorks extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders_works';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_order', 'id_work'], 'integer'],
            [['id_order'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['id_order' => 'id']],
            [['id_work'], 'exist', 'skipOnError' => true, 'targetClass' => Works::className(), 'targetAttribute' => ['id_work' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_order' => 'Id Order',
            'id_work' => 'Id Work',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Orders::className(), ['id' => 'id_order']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWork()
    {
        return $this->hasOne(Works::className(), ['id' => 'id_work']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\OrdersWorksQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\OrdersWorksQuery(get_called_class());
    }
}
