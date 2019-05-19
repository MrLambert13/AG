<?php

namespace app\modules\api\models;

use app\models\Users;
use app\models\UserTokens;
use yii\base\Model;

class LoginForm extends Model
{
    public $username;
    public $password;

    private $_user;

    /**
     * @return array
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    /**
     * @param $attribute
     * @param $params
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * @return Users|null
     */
    protected function getUser()
    {
        if ($this->_user === null) {
            $this->_user = Users::findByUsername($this->username);
        }

        return $this->_user;
    }

    /**
     * @return UserTokens|null
     */
    public function auth()
    {
        if ($this->validate()) {
            $token = new UserTokens();
            $token->id_user = $this->getUser()->id;
            $token->generateToken(time() + 3600 * 24);
            return $token->save() ? $token : null;
        } else {
            return null;
        }
    }
}