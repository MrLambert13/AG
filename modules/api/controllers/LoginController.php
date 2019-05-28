<?php

namespace app\modules\api\controllers;

use app\models\Users;
use app\models\UserTokens;
use app\modules\api\models\LoginForm;
use Yii;
use yii\rest\Controller;
use yii\filters\Cors;

/**
 * Default controller for the `modules` module
 */
class LoginController extends Controller
{

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return 'api';
    }

//    public function behaviors()
//    {
//        $behaviors = parent::behaviors();
//
//        // add CORS filter
//        $behaviors['corsFilter'] = [
//            'class' => Cors::className(),
//            'cors' => [
//                'Origin' => ['*'],
//                'Access-Control-Request-Method' => ['GET', 'POST', 'PUT', 'PATCH', 'DELETE', 'HEAD'],
//                'Access-Control-Allow-Credentials' => true,
//            ],
//
//        ];
//
//
//        return $behaviors;
//    }

    public function actionLogin()
    {
        $params = Yii::$app->request->bodyParams;
        $user = Users::findByEmail($params['email']);
        if (!$user) {
            $user = Users::findByUsername($params['username']);
            if (!$user) {
                $result = [
//                    'params' => json_encode($params),
//                    'params' => $params['username'],
                    'success' => 0,
                    'message' => 'Такой пользователь не найден'
                ];
                return $result;
            }
        }

        if ($user)
            if (!$user->validatePassword($params['password'])) {
                $result = [
                    'success' => 0,
                    'message' => 'Неверный пароль'
                ];
                return $result;
            } else {
                $model = new LoginForm();
                $model->load($params, '');
                if ($token = $model->auth()) {
                    return [
                        'token' => $token->token,
                        'expired' => date(DATE_RFC3339, $token->expire_time),
                    ];
                } else {
                    return $model;
                }
            }
    }

    public function actionRegister()
    {
        $params = Yii::$app->request->bodyParams;
        $user = Users::findByEmail($params['email']);

        if (!$user) {
            $user = Users::findByUsername($params['username']);
            if ($user) {
                $result = [
                    'success' => 0,
                    'message' => 'Пользователь с таким именем уже существует',
                    'code' => 'username_busy'
                ];
                return $result;
            }
        } else {
            $result = [
                'success' => 0,
                'message' => 'Пользователь с таким адресом электронной почты уже существует',
                'code' => 'email_busy'
            ];
            return $result;
        }

        if (!$user) {

            $user = new Users();
            $user->username = $params['username'];
            $user->email = $params['email'];
            $user->setPassword($params['password']);
            $user->generateAuthKey();
//            $user->save();

            if ($user->save()) {
                $token = new UserTokens();
                $token->token = Yii::$app->security->generateRandomString();
                $token->id_user = $user->id;
                $token->expire_time = time() + 3600 * 5;
                if ($token->save()) {
                    UserTokens::deleteAll('expire_time < ' . time());
                    $result = [
                        'success' => 1,
                        'username' => $user->username,
                        'userId' => $user->id,
                        'payload' => $user,
                        'token' => $token->token,
                        'expired' => date(DATE_RFC3339, $token->expire_time),
                    ];
                    return $result;
                } else {
                    return $token;
                }
            } else {
                return $user;
            }
        }
    }


    public function actionLogout()
    {
        $params = Yii::$app->request->bodyParams;
        $user = Users::findByEmail($params['email']);
        if ($user->tokens) {
            $token = UserTokens::findOne(['id_user' => $user->id]);
            $token->token = NULL;
            if ($token->save()) {
                return ['massage' => 'Вы вышли'];
            } else {
                return $token;
            }
        } else {
            return $user;
        }
    }

    protected function verbs()
    {
        return [
            'login' => ['post']
        ];
    }
}
