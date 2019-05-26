<?php

namespace app\modules\api\controllers;

use app\models\ServiceTypes;
use app\models\Users;
use app\models\WorkTypes;
use app\models\WorkCategories;
use app\models\UserTokens;
use Yii;
use yii\rest\Controller;

/**
 * Controller for CRUD services
 */
class ServiceController extends Controller
{
    const USER_TYPE_STO = 2;

    /**
     * @return Users|\yii\web\IdentityInterface|null
     */
    public function findUser()
    {
        $params = Yii::$app->request->bodyParams;

        return Users::findIdentity($params['id_user']);
    }

    /**
     * Renders the index view for the module
     * @return array
     */
    public function actionIndex()
    {
        if (!$this->findUser()->isSto()) {
            $result = [
                'success' => 0,
                'message' => 'Access denied',
                'code' => 'user_type_incorrect',
            ];
        }
        return $result;
    }

    public function actionCreate()
    {
        $params = Yii::$app->request->bodyParams;
        $user = $this->findUser();

        if (!$user->isSto()) {
            return $result = [
                'success' => 0,
                'message' => 'Access denied',
                'code' => 'user_type_incorrect',
            ];
        }

        $service_type = new ServiceTypes();
        $service_type->name = $params['service_name'];
        $service_type->id_sto = $user->id;
    }


}
