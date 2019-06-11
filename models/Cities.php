<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cities".
 *
 * @property int $id
 * @property string $name
 * @property int $timezone
 * @property int $id_region
 *
 * @property Regions $region
 * @property Orders[] $orders
 * @property UsersInfo[] $usersInfos
 */
class Cities extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cities';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['timezone', 'id_region'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['id_region'], 'exist', 'skipOnError' => true, 'targetClass' => Regions::className(), 'targetAttribute' => ['id_region' => 'id']],
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
            'timezone' => 'Timezone',
            'id_region' => 'Id Region',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRegion()
    {
        return $this->hasOne(Regions::className(), ['id' => 'id_region']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['id_city' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsersInfos()
    {
        return $this->hasMany(UsersInfo::className(), ['id_city' => 'id']);
    }
}
