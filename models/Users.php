<?php

namespace app\models;

use app\models\query\UserQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "Users".
 * @property int     $id
 * @property string  $password_hash
 * @property string  $auth_key
 * @property int     $created_at
 * @property int     $updated_at
 * @property string  $username
 * @property string  $email
 * @property integer $status
 * @property integer $id_user_type
 */
class Users extends ActiveRecord implements IdentityInterface
{

    const STATUS_DELETED = 0;
    const STATUS_ACTIVE = 10;
    const USER_TYPE_CLIENT = 1;
    const USER_TYPE_STO = 2;
    const USER_TYPE_GUEST = 3;
    const USER_TYPE_ADMIN = 4;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
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
            [['password_hash', 'username', 'email'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['password_hash', 'auth_key'], 'string', 'max' => 255],
            [['username'], 'string', 'max' => 32],
            [['email'], 'string', 'max' => 128],
            [['username'], 'unique'],
            [['email'], 'unique'],
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
            'email' => 'Email',
        ];
    }

    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
        return $this->getPrimaryKey();
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

    public function getUsername()
    {
        return Yii::$app->user->identity->getId();
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

    public static function find()
    {
        return new UserQuery(get_called_class());
    }

    public function getTokens()
    {
        return $this->hasMany(UserTokens::class, ['id_user' => 'id']);
    }

    public function isSto()
    {
        return $this->id_user_type === self::USER_TYPE_STO;
    }

    public function isClient()
    {
        return $this->id_user_type === self::USER_TYPE_CLIENT;
    }
}
