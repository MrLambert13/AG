<?php
//
//
//namespace app\controllers;
//
//
//use app\models\Users;
//use app\models\UserTokens;
//use Yii;
//use yii\data\ActiveDataProvider;
//use yii\db\ActiveRecord;
//use yii\rest\ActiveController;
//
//class UserController extends ActiveController
//{
//    public $modelClass = Users::class;
//
//    public function actions()
//    {
//        $actions = parent::actions();
//        unset($actions['index']);
//        return $actions;
//    }
//
////    public function actionIndex()
////    {
////        $filter = Yii::$app->request->get('filter');
////        $query = Users::find();
////        if ($filter) {
////            $query->filterWhere($filter);
////        }
////        return new ActiveDataProvider([
////            'query' => $query
////        ]);
////    }
//
//    public function actionIndex()
//    {
//        $this->enableCsrfValidation = false;
////        $params = Yii::$app->request->getBodyParams();
//        $user = Users::findByEmail(Yii::$app->request->getBodyParam('username'));
//        if (!$user) {
//            $user = Users::findByUsername(Yii::$app->request->getBodyParam('username'));
//            if (!$user)
//                $result = [
//                    'success' => 0,
//                    'message' => 'No such user found'
//                ];
//        }
//        if ($user)
//            if (!$user->validatePassword(Yii::$app->request->getBodyParam('password'))) {
//                $result = [
//                    'success' => 0,
//                    'message' => 'Incorrect password'
//                ];
//            } else {
//                $token = new UserTokens();
//                $token->token = Yii::$app->security->generateRandomString(12);
//                $token->user = $user->id;
//                    $token->expire_time = time() + 3600 * 5;
//                $token->save();
//                UserTokens::deleteAll('expire_time < ' . time());
//                $result = [
//                    'success' => 1,
//                    'username' => $user->username,
//                    'payload' => $user,
//                    'token' => $token->token
//                ];
//            }
//        echo json_encode($result);
//
//    }
//    public function actionRegister()
//    {
////        $params = Yii::$app->request->getBodyParam('email');
//        $user = Users::findByEmail(Yii::$app->request->getBodyParam('email'));
//
//        if (!$user) {
//            $user = Users::findByUsername(Yii::$app->request->getBodyParam('username'));
//            if ($user)
//                $result = [
//                    'success' => 0,
//                    'message' => 'User with this username already exist',
//                    'code' => 'username_busy'
//                ];
//        } else {
//            $result = [
//                'success' => 0,
//                'message' => 'User with this email already exist',
//                'code' => 'email_busy'
//            ];
//        }
//
//        if (!$user) {
//            $user = new Users();
//            $user->username = Yii::$app->request->getBodyParam('username');
//            $user->created_at = gmdate("Y-m-d H:i:s");
//            $user->updated_at = gmdate("Y-m-d H:i:s");
//            $user->email = Yii::$app->request->getBodyParam('email');
//            $user->setPassword(Yii::$app->request->getBodyParam('password'));
//            $user->generateAuthKey();
//            $user->save();
//
//            $token = new UserTokens();
//            $token->token = Yii::$app->security->generateRandomString(12);
//            $token->user = 3;
//            $token->expire_time = time() + 3600 * 5;
//            $token->save();
//            UserTokens::deleteAll('expire_time < ' . time());
//            $result = [
//                'success' => 1,
//                'username' => $user->username,
//                'userId' => $user->id,
//                'payload' => $user,
//                'token' => $token->token
//            ];
//        }
//        return $result;
//
//    }
//}