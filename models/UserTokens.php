<?php

namespace app\models;

use Yii;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "user_tokens".
 *
 * @property int $id
 * @property int $id_user
 * @property string $token
 * @property int $expire_time
 *
 * @property Users $user
 */
class UserTokens extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_tokens';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user'], 'required'],
            [['id_user', 'expire_time'], 'integer'],
            [['token'], 'string', 'max' => 255],
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
            'id_user' => 'Id User',
            'token' => 'Token',
            'expire_time' => 'Expire Time',
        ];
    }

    /**
     * @return ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::class, ['id' => 'id_user']);
    }

    /**
     * Generate Token
     *
     * @param integer $expire
     * 
     * @return void
     */
    public function generateToken(int $expire)
    {
        $this->expire_time = $expire;
        $this->token = Yii::$app->security->generateRandomString();
    }
}
