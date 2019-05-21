<?php

namespace app\modules\api\controllers;

use app\models\Sto;
use app\models\Users;
use Yii;
use yii\rest\Controller;

/**
 * Default controller for the `api` module
 */
class StoController extends Controller
{
    public $modelClass = Sto::class;

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return 'api-sto';
    }

    public function actionCreate()
    {
        $params = Yii::$app->request->bodyParams;

        $result = $this->isUnique($params['username'], $params['email'], $params['telephone'], $params['name']);
        if (!$result) {
            $sto = new Sto();
            $sto->username = $params['username'];
            $sto->email = $params['email'];
            $sto->telephone = $params['telephone'];
            $sto->name = $params['name'];
            $sto->setPassword($params['password']);
            $sto->generateAuthKey();

            $sto->save();

            $result = [
                'success' => 1,
                'username' => $sto->username,
                'name' => $sto->name,
                'telephone' => $sto->telephone,
                'userId' => $sto->id,
            ];
        }


        return $result;
    }

    /**
     * Check is STO unique
     * @param $username
     * @param $email
     * @param $tel
     * @param $name
     *
     * @return array|bool
     */
    public function isUnique($username, $email, $tel, $name)
    {
        $result = false;

        $sto = Sto::findByUsername($username);
        if ($sto) {
            $result = [
                'success' => 0,
                'message' => 'СТО с таким именем уже существует',
                'code' => 'username_busy'
            ];
        }

        $sto = Sto::findByEmail($email);
        if ($sto) {
            $result = [
                'success' => 0,
                'message' => 'СТО с таким адресом почты уже существует',
                'code' => 'email_busy'
            ];
        }

        $sto = Sto::findByTel($tel);
        if ($sto) {
            $result = [
                'success' => 0,
                'message' => 'СТО с таким телефоном уже существует',
                'code' => 'telephone_busy'
            ];
        }

        $sto = Sto::findByName($name);
        if ($sto) {
            $result = [
                'success' => 0,
                'message' => 'СТО с таким названием уже существует',
                'code' => 'name_busy'
            ];
        }

        return $result;
    }
}
