<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bonuses".
 * @property int      $id
 * @property string   $name
 * @property double   $size
 * @property int      $used_count
 * @property int      $max_count
 * @property int      $id_vip_card
 * @property VipCards $vipCard
 */
class Bonuses extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'bonuses';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'size'], 'required'],
            [['size'], 'number'],
            [['used_count', 'max_count', 'id_vip_card'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id_vip_card'], 'exist', 'skipOnError' => true, 'targetClass' => VipCards::class, 'targetAttribute' => ['id_vip_card' => 'id']],
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
            'size' => 'Size',
            'used_count' => 'Used Count',
            'max_count' => 'Max Count',
            'id_vip_card' => 'Id Vip Card',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getVipCard()
    {
        return $this->hasOne(VipCards::className(), ['id' => 'id_vip_card']);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\query\BonusesQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \app\models\query\BonusesQuery(get_called_class());
    }
}
