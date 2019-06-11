<?php

namespace app\models;

use Yii;
use app\models\Cities;

/**
 * This is the model class for table "users_info".
 *
 * @property int $id
 * @property int $id_user
 * @property string $surname
 * @property string $name
 * @property string $middlename
 * @property int $birthday
 * @property string $telegram_name
 * @property string $telephone
 * @property int $id_city
 *
 * @property Cities $city
 * @property Users $user
 */
class UsersInfo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'users_info';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'surname', 'name', 'birthday', 'telephone', 'id_city'], 'required'],
            [['id_user', 'birthday', 'id_city'], 'integer'],
            [['surname', 'name', 'middlename', 'telegram_name'], 'string', 'max' => 255],
            [['telephone'], 'string', 'max' => 10],
            [['telephone'], 'unique'],
            [['id_city'], 'exist', 'skipOnError' => true, 'targetClass' => Cities::className(), 'targetAttribute' => ['id_city' => 'id']],
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
            'surname' => 'Surname',
            'name' => 'Name',
            'middlename' => 'Middlename',
            'birthday' => 'Birthday',
            'telegram_name' => 'Telegram Name',
            'telephone' => 'Telephone',
            'id_city' => 'Id City',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCity()
    {
        return $this->hasOne(Cities::className(), ['id' => 'id_city']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'id_user']);
    }
}
