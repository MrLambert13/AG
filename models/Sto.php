<?php

namespace app\models;

use Yii;
use app\models\query\StoQuery;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "sto".
 *
 * @property int $id
 * @property string $password_hash
 * @property string $auth_key
 * @property int $created_at
 * @property int $updated_at
 * @property string $username
 * @property string $name
 * @property string $geo
 * @property int $rate
 * @property int $id_order
 * @property string $address
 * @property string $telephone
 * @property string $email
 *
 * @property Basket[] $baskets
 * @property Feedback[] $feedbacks
 * @property ServiceTypes[] $serviceTypes
 * @property Orders $order
 * @property VipCards[] $vipCards
 * @property Works[] $works
 */
class Sto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'sto';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ]
            ]

        ];
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password_hash', 'username', 'name', 'telephone'], 'required'],
            [['created_at', 'updated_at', 'rate', 'id_order'], 'integer'],
            [['password_hash', 'auth_key', 'name', 'geo', 'address', 'email'], 'string', 'max' => 255],
            [['username'], 'string', 'max' => 32],
            [['telephone'], 'string', 'max' => 10],
            [['username'], 'unique'],
            [['telephone'], 'unique'],
            [['email'], 'unique'],
            [['id_order'], 'exist', 'skipOnError' => true, 'targetClass' => Orders::className(), 'targetAttribute' => ['id_order' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'password_hash' => 'Password Hash',
            'auth_key' => 'Auth Key',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'username' => 'Username',
            'name' => 'Name',
            'geo' => 'Geo',
            'rate' => 'Rate',
            'id_order' => 'Id Order',
            'address' => 'Address',
            'telephone' => 'Telephone',
            'email' => 'Email',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBaskets()
    {
        return $this->hasMany(Basket::className(), ['id_sto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFeedbacks()
    {
        return $this->hasMany(Feedback::className(), ['id_sto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServiceTypes()
    {
        return $this->hasMany(ServiceTypes::className(), ['id_sto' => 'id']);
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
    public function getVipCards()
    {
        return $this->hasMany(VipCards::className(), ['id_sto' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWorks()
    {
        return $this->hasMany(Works::className(), ['id_sto' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return StoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new StoQuery(get_called_class());
    }

    public static function findByEmail($email)
    {
        return $model = static::findOne(['email' => $email]);
    }

    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }

    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password_hash);
    }
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString(24);
    }

    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }
}
