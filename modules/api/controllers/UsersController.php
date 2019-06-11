<?php

namespace app\modules\api\controllers;

use Yii;
use app\models\Users;
use app\models\UsersInfo;
use yii\rest\Controller;
use app\models\Regions;
use app\models\Countries;
use app\models\UserTokens;

/**
 * Default controller for the `api` module
 */
class UsersController extends Controller
{
    protected function verbs()
    {
        return [
            'profile' => ['post']
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return 'api Users';
    }

    /**
     * API Обновить/Показать данные в ЛК (ТО)
     * 
     * @var Users $user
     * @var UsersInfo $userInfo
     * 
     * @return array
     */
    public function actionProfile()
    {
        $params = Yii::$app->request->bodyParams; // POST
        
        // проверяем наличие токена и ID
        if (
            !array_key_exists('token', $params) ||
            !array_key_exists('id_user', $params)
        ) {
            return [
                'success' => 'error',
                'message' => 'Token или ID в запросе отсутствуют!'
            ];
        }

        // записываем переданные параметры
        $token = $params['token'];
        $id_user = $params['id_user'];

        // получаем пользователя из БД
        $user = Users::findOne(['id' => $id_user]);

        // если пользователь не был найден
        if (!$user) {
            return [
                'success' => 'error',
                'message' => 'Пользователь с ID = ' . $id_user . ' не найден'
            ];
        }

        $user_tokens = $user->tokens; // получаем все токены пользователя
        $user_tokens_count = count($user_tokens); // кол-во найденных токенов
        $authentication = false; // Аутентификация

        // перебираем все токены из БД
        for ($i = 0; $i < $user_tokens_count; $i++) {
            // один из токенов в БД
            $token_db = $user_tokens[$i]->attributes['token']; 
            // если нужный токен найден
            if ($token_db === $token) {
                // если токен "умер"
                if ($user_tokens[$i]->attributes['expire_time'] < time()) {
                    // удаляем все старые токены
                    UserTokens::deleteAll('expire_time < ' . time());
                    return [
                        'success' => 'error',
                        'message' => 'Время жизни токена прошло...'
                    ];
                }
                $authentication = true; // Аутентификация прошла успешно
                break;
            }
        }

        // если аутентификация НЕ прошла
        if (!$authentication) {
            return [
                'success' => 'error',
                'message' => 'Аутентификация не пройдена!'
            ];
        }

        // получаем доп. информацию о пользователе из БД
        $userInfo = UsersInfo::findOne(['id_user' => $id_user]);
        $region = Regions::findOne(['id' => $userInfo->city['id_region']]);
        $country = Countries::findOne(['id' => $region->id_country]);

        // собираем структуру ответа
        $response = [];
        $response['success'] = 'ok';
        $response['id'] = $user->id;
        $response['username'] = $user->username;
        $response['created_at'] = $user->created_at;
        $response['updated_at'] = $user->updated_at;
        $response['email'] = $user->email;
        $response['status'] = $user->status;
        $response['user_type'] = $user->getUserTipe()->one()['name'];
        $response['surname'] = $userInfo->surname;
        $response['name'] = $userInfo->name;
        $response['middlename'] = $userInfo->middlename;
        $response['birthday'] = $userInfo->birthday;
        $response['telegram'] = $userInfo->telegram_name;
        $response['telephone'] = $userInfo->telephone;
        $response['city'] = $userInfo->city['name'];
        $response['region'] = $region['description'];
        $response['country'] = $region->country['name'];
        $response['currency'] = $country->currency['name'];

        // ответ
        return $response;
    }
}
