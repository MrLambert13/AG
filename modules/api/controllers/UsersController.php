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
            'update-info' => ['post'],
            'update-email' => ['post'],
            'update-password' => ['post'],
        ];
    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return 'api UsersController';
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

        // необходимые параметры
        $paramsNeed = array(
            'id_user',
            'token',
        );

        // параметры, которые не должны быть пустыми
        $paramsNotNull = array(
            'id_user',
            'token',
        );

        // проверяем полученные параметры
        $resultParamsNeed = $this->validateParamsNeed($params, $paramsNeed);
        if ($resultParamsNeed['result'] == 'error') {
            return $resultParamsNeed;
        }

        $resultParamsNotNull = $this->validateParamsNotNull($params, $paramsNotNull);
        if ($resultParamsNotNull['result'] == 'error') {
            return $resultParamsNotNull;
        }

        // записываем переданные параметры
        $token = $params['token'];
        $id_user = $params['id_user'];

        // проверяем токен
        $resultToken = $this->validateToken($token, $id_user);
        if ($resultToken['result'] == 'error') {
            return $resultToken;
        }

        // получаем юзера из БД
        $user = $resultToken['user'];

        // получаем доп. информацию о пользователе из БД
        if (!$userInfo = UsersInfo::findOne(['id_user' => $id_user])) {
            return $this->sendError('UsersInfo не найден!');
        }
        if (!$region = Regions::findOne(['id' => $userInfo->city['id_region']])) {
            return $this->sendError('Regions не найден!');
        }
        if (!$country = Countries::findOne(['id' => $region->id_country])) {
            return $this->sendError('Countries не найден!');
        }

        // собираем структуру ответа
        $response = [];
        $response['result'] = 'ok';
        $response['id'] = $user->id;
        $response['username'] = $user->username;
        $response['created_at'] = $user->created_at;
        $response['updated_at'] = $user->updated_at;
        $response['email'] = $user->email;
        $response['status'] = $user->status;
        $response['user_type'] = $user->getUserType()->one()['name'];
        $response['surname'] = $userInfo->surname;
        $response['name'] = $userInfo->name;
        $response['middlename'] = $userInfo->middlename;
        $response['birthday'] = $userInfo->birthday;
        $response['telegram'] = $userInfo->telegram_name;
        $response['telephone'] = $userInfo->telephone;
        $response['city'] = $userInfo->city['name'];
        $response['id_city'] = $userInfo->city['id'];
        $response['region'] = $region['description'];
        $response['country'] = $region->country['name'];
        $response['currency'] = $country->currency['name'];

        return $response; // ответ
    }

    /**
     * API обновить/изменить данные в ЛК (клиента)
     *
     * @var Users $user
     * 
     * @return array
     */
    public function actionUpdateInfo()
    {
        // получаем переданные параметры
        $params = Yii::$app->request->bodyParams; // POST

        // необходимые параметры
        $paramsNeed = array(
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

        // параметры, которые не должны быть пустыми
        $paramsNotNull = array(
            'username',
            'id_city',
        );

        // проверяем полученные параметры
        $resultParamsNeed = $this->validateParamsNeed($params, $paramsNeed);
        if ($resultParamsNeed['result'] == 'error') {
            return $resultParamsNeed;
        }

        $resultParamsNotNull = $this->validateParamsNotNull($params, $paramsNotNull);
        if ($resultParamsNotNull['result'] == 'error') {
            return $resultParamsNotNull;
        }

        // записываем переданные параметры
        $token = $params['token'];
        $id_user = $params['id_user'];

        // проверяем токен
        $resultToken = $this->validateToken($token, $id_user);
        if ($resultToken['result'] == 'error') {
            return $resultToken;
        }

        // получаем юзера из БД
        $user = $resultToken['user'];

        // получаем доп. информацию о пользователе из БД
        if (!$userInfo = UsersInfo::findOne(['id_user' => $id_user])) {
            return $this->sendError('UsersInfo не найден!');
        }

        $paramsNewUser = []; // параметры которые будут изменены
        $paramsNewInfo = []; // параметры которые будут изменены

        // удаляем лишнее
        unset($params['token']);
        unset($params['id_user']);

        // изменяем только новые параметры в записях
        foreach ($params as $key => $value) {
            if (isset($user->$key)) {
                if ($user->$key != $value) {
                    $user->$key = $value;
                    $paramsNewUser[$key] = $value;
                    continue;
                }
            }
            if (isset($userInfo->$key)) {
                if ($userInfo->$key != $value) {
                    $userInfo->$key = $value;
                    $paramsNewInfo[$key] = $value;
                }
            }
        }

        // массив с результатами изменений
        $result = [
            'result' => 'ok',
            'user_upd' => '',
            'user_info_upd' => '',
        ];

        // проверяем основные параметры на изменения
        if (count($paramsNewUser) > 0) {
            if ($user->save()) {
                $result['user_upd'] = 'success';
            } else {
                $result['result'] = 'error';
                $result['user_upd'] = $user->getErrors();
            }
        }

        // проверяем доп. параметры на изменения
        if (count($paramsNewInfo) > 0) {
            if ($userInfo->save()) {
                $result['user_info_upd'] = 'success';
            } else {
                $result['result'] = 'error';
                $result['user_info_upd'] = $userInfo->getErrors();
            }
        }

        return $result; // результат работы
    }

    /**
     * API обновить E-mail
     *  // ЗАГЛУШКА требует переработки
     * @var Users $user
     * 
     * @return array
     */
    public function actionUpdateEmail()
    {
        // получаем переданные параметры
        $params = Yii::$app->request->bodyParams; // POST
        //$params = Yii::$app->request->queryParams; // GET

        // необходимые параметры
        $paramsNeed = array(
            'id_user',
            'token',
            'email',
        );

        // параметры, которые не должны быть пустыми
        $paramsNotNull = array(
            'id_user',
            'token',
            'email',
        );

        // проверяем полученные параметры
        $resultParamsNeed = $this->validateParamsNeed($params, $paramsNeed);
        if ($resultParamsNeed['result'] == 'error') {
            return $resultParamsNeed;
        }

        $resultParamsNotNull = $this->validateParamsNotNull($params, $paramsNotNull);
        if ($resultParamsNotNull['result'] == 'error') {
            return $resultParamsNotNull;
        }

        // записываем переданные параметры
        $token = $params['token'];
        $id_user = $params['id_user'];
        $email = $params['email'];

        // проверяем токен
        $resultToken = $this->validateToken($token, $id_user);
        if ($resultToken['result'] == 'error') {
            return $resultToken;
        }

        // получаем юзера из БД
        $user = $resultToken['user'];

        // если новая почта отличается, меняем и сохраняем
        /**
         * @var Users $user
         */
        if ($email != $user->email) {
            $user->email = $email;
            if ($user->save()) {
                return [
                    'result' => 'ok',
                    'message' => 'Новый E-mail был сохранен!'
                ];
            } else {
                return $this->sendError('Ошибка сохранения Email!', $user->getErrors());
            }
        }

        return [
            'result' => 'ok',
            'message' => 'Полученный E-mail соот. сохраненому в БД!'
        ];
    }

    /**
     * API обновить Пароль
     *  // ЗАГЛУШКА требует переработки
     * @var Users $user
     * 
     * @return array
     */
    public function actionUpdatePassword()
    {
        // получаем переданные параметры
        $params = Yii::$app->request->bodyParams; // POST
        //$params = Yii::$app->request->queryParams; // GET

        // необходимые параметры
        $paramsNeed = array(
            'id_user',
            'token',
            'pass_old',
            'pass_new',
        );

        // параметры, которые не должны быть пустыми
        $paramsNotNull = array(
            'id_user',
            'token',
            'pass_old',
            'pass_new',
        );

        // проверяем полученные параметры
        $resultParamsNeed = $this->validateParamsNeed($params, $paramsNeed);
        if ($resultParamsNeed['result'] == 'error') {
            return $resultParamsNeed;
        }

        $resultParamsNotNull = $this->validateParamsNotNull($params, $paramsNotNull);
        if ($resultParamsNotNull['result'] == 'error') {
            return $resultParamsNotNull;
        }

        // записываем переданные параметры
        $token = $params['token'];
        $id_user = $params['id_user'];
        $pass_old = $params['pass_old'];
        $pass_new = $params['pass_new'];

        // если пароли равны
        if ($pass_old === $pass_new) {
            return [
                'result' => 'warning',
                'message' => 'Старый и новый пароли не должны быть одинаковыми!'
            ];
        }

        // проверяем токен
        $resultToken = $this->validateToken($token, $id_user);
        if ($resultToken['result'] == 'error') {
            return $resultToken;
        }

        // получаем юзера из БД
        $user = $resultToken['user'];

        // проверяем старый пароль пользователя
        /**
         * @var Users $user
         */
        if ($user->validatePassword($pass_old)) {
            $user->setPassword($pass_new);
            if ($user->save()) {
                return [
                    'result' => 'ok',
                    'message' => 'Новый пароль сохранен!'
                ];
            } else {
                return $this->sendError('Ошибка сохранения пароля!', $user->getErrors());
            }
        }

        return $this->sendError('Старый пароль не верен!');
    }

    /**
     * Проверка токена
     *
     * @param string $token
     * @param integer $id_user
     * 
     * @var Users $user
     * 
     * @return array
     */
    private function validateToken(string $token, int $id_user)
    {
        // получаем пользователя из БД
        $user = Users::findOne(['id' => $id_user]);

        // если пользователь не был найден
        if (!$user) {
            return $this->sendError('Пользователь с ID = ' . $id_user . ' не найден!');
        }

        $user_tokens = $user->tokens; // получаем все токены пользователя
        $user_tokens_count = count($user_tokens); // кол-во найденных токенов

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
                    return $this->sendError('Время жизни токена вышло...');
                }
                return [
                    'result' => 'ok',
                    'user' => $user
                ];
            }
        }

        // если токен не был идентифицирован
        return $this->sendError('Токен не действителен!');
    }

    /**
     * Проверка полученных параметров
     *
     * @param array $params
     * @param array $paramsNeed // массив с нужными параметрами
     * 
     * @return array
     */
    private function validateParamsNeed(array $params, array $paramsNeed)
    {
        // массив ключей с ожидаемыми параметрами
        $paramsExpected = array_fill_keys($paramsNeed, '');

        // сравниваем необходимые параметры с полученными
        $arr_diff = array_diff_key($paramsExpected, $params);

        // проверяем рассхождение параметров (массив должен быть пустым)
        if (count($arr_diff) > 0) {
            return $this->sendError('Не все параметры были переданы!', $arr_diff);
        }

        return [
            'result' => 'ok'
        ];
    }

    /**
     * Проверка параметров на пустые значения
     *
     * @param array $params
     * @param array $paramsNotNull
     * 
     * @return array
     */
    private function validateParamsNotNull(array $params, array $paramsNotNull)
    {
        // проверяем параметры, которые не должны быть пустыми
        foreach ($paramsNotNull as $key) {
            if (empty($params[$key])) {
                return $this->sendError('Эти параметры не должны быть пустыми:', $paramsNotNull);
            }
        }

        return [
            'result' => 'ok'
        ];
    }

    /**
     * Отправить ошибку
     *
     * @param string $message
     * @param array $extra
     * 
     * @return array
     */
    private function sendError(string $message, array $extra = [])
    {
        $result = [
            'result' => 'error',
            'message' => $message
        ];

        if ($extra) {
            $result['extra'] = $extra;
        }

        return $result;
    }
}
