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
            'profile' => ['post'],
            'update' => ['post'],
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
        // получаем переданные параметры
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

    /**
     * API обновить/изменить данные в ЛК (клиента)
     * !!! "сырой" требует обновления
     * @return void
     */
    public function actionUpdate()
    {
        // получаем переданные параметры
        $params = Yii::$app->request->bodyParams; // POST
        //$params = Yii::$app->request->queryParams; // GET
        // необходимые ключи в параметрах
        $keys = array(
            'id_user',
            'token',
            'username',
            'status',
            'id_user_type',
            'surname',
            'name',
            'middlename',
            'birthday',
            'telegram_name',
            'telephone',
            'id_city',
        );
        // массив ключей с ожидаемыми параметрами
        $params_expected = array_fill_keys($keys, '');
        // сравниваем необходимые параметры с полученными
        $arr_diff = array_diff_key($params_expected, $params);
        // проверяем рассхождение параметров (массив должен быть пустым)
        if (count($arr_diff) > 0) {
            return [
                'success' => 'error',
                'message' => 'Не все параметры были переданы!'
            ];
        }
        // параметры, которые не должны быть пустыми
        $keys_not_null = array(
            'username',
            'id_city',
        );
        // проверяем параметры, которые не должны быть пустыми
        foreach ($keys_not_null as $key) {
            if (empty($params[$key])) {
                return [
                    'success' => 'error',
                    'message' => 'Параметры "username", "id_city" не должны быть пустыми!'
                ];
            }
        }
        // попробуем записать в БД
        $token = $params['token'];
        if (!$userToken = UserTokens::findOne(['token' => $token])) {
            return [
                'success' => 'error',
                'message' => 'Токен не найден!'
            ];
        }
        
        $id_user = $userToken->id_user;
        if ($id_user != $params['id_user']) {
            return [
                'success' => 'error',
                'message' => 'ID пользователя не верен!'
            ];
        }

        if (!$user_class = Users::findOne(['id' => $id_user])) {
            return [
                'success' => 'error',
                'message' => 'User с таким ID не найден!'
            ];
        }
        if (!$user_info_class = UsersInfo::findOne(['id_user' => $id_user])) {
            return [
                'success' => 'error',
                'message' => 'Доп. инфо о пользователе НЕ найдена!'
            ];
        }
        $paramsNewUser = []; // параметры которые будут изменены
        $paramsNewInfo = []; // параметры которые будут изменены
        // удаляем лишнее
        unset($params['token']);
        unset($params['id_user']);
        // изменяем только новые параметры в записях
        foreach ($params as $key => $value) {
            if (isset($user_class->$key)) {
                if ($user_class->$key != $value) {
                    $user_class->$key = $value;
                    $paramsNewUser[$key] = $value;
                    continue;
                }
            }
            if (isset($user_info_class->$key)) {
                if ($user_info_class->$key != $value) {
                    $user_info_class->$key = $value;
                    $paramsNewInfo[$key] = $value;
                }
            }
        }
        // массив с результатами изменений
        $result = [
            'user_upd' => '',
            'user_info_upd' => '',
        ];
        // проверяем основные параметры на изменения
        if (count($paramsNewUser) > 0) {
            if ($user_class->save()) {
                $result['user_upd'] = 'success';
            } else {
                $result['user_upd'] = $user_class->getErrors();
            }
        }
        // проверяем доп. параметры на изменения
        if (count($paramsNewInfo) > 0) {
            if ($user_info_class->save()) {
                $result['user_info_upd'] = 'success';
            } else {
                $result['user_info_upd'] = $user_info_class->getErrors();
            }
        }
        return $result; // результат работы
    }
}
