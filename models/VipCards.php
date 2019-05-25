<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "vip_cards".
 * @property int       $id
 * @property int       $number
 * @property int       $status
 * @property int       $created_at
 * @property int       $updated_at
 * @property int       $id_sto
 * @property int       $id_user
 * @property Bonuses[] $bonuses
 * @property Users     $sto
 * @property Users     $user
 */
class VipCards extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'vip_cards';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['number'], 'required'],
            [['number', 'status', 'created_at', 'updated_at', 'id_sto', 'id_user'], 'integer'],
            [['id_sto'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['id_sto' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::class, 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number' => 'Number',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'id_sto' => 'Id Sto',
            'id_user' => 'Id User',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBonuses()
    {
        return $this->hasMany(Bonuses::class, ['id_vip_card' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSto()
    {
        return $this->hasOne(Users::class, ['id' => 'id_sto']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'id_user']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\VipCardsQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\VipCardsQuery(get_called_class());
    }
}
