<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sto_info".
 *
 * @property int $id
 * @property int $id_user
 * @property string $name
 * @property string $geo
 * @property int $rate
 * @property int $id_order
 * @property string $address
 * @property string $telephone
 *
 * @property Orders $order
 * @property Users $user
 */
class StoInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sto_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'name', 'telephone'], 'required'],
            [['id_user', 'rate', 'id_order'], 'integer'],
            [['name', 'geo', 'address'], 'string', 'max' => 255],
            [['telephone'], 'string', 'max' => 10],
            [['telephone'], 'unique'],
            [['id_order'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['id_order' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_user' => 'Id User',
            'name' => 'Name',
            'geo' => 'Geo',
            'rate' => 'Rate',
            'id_order' => 'Id Order',
            'address' => 'Address',
            'telephone' => 'Telephone',
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
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\StoInfoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\StoInfoQuery(get_called_class());
    }
}
