<?php

namespace app\modules\api\controllers;

use app\models\ServiceTypes;
use app\models\Users;
use app\models\WorkTypes;
use Yii;
use yii\db\StaleObjectException;
use yii\rest\Controller;

/**
 * Controller for CRUD services
 */
class ServiceTypeController extends Controller
{
    /**
     * @return Users|\yii\web\IdentityInterface|null
     */
    private function findUser()
    {
        $params = Yii::$app->request->bodyParams;

        return Users::findIdentity($params['idUser']);
    }

    public function validateUser()
    {
        $user = $this->findUser();

        if (!$user->isSto()) {
            return $result = [
                'success' => 0,
                'message' => 'Access denied',
                'code' => 'user_type_incorrect',
            ];
        }
    }

    /**
     * @return array
     */
    public function validateOwner()
    {
        $params = Yii::$app->request->bodyParams;
        $serviceType = ServiceTypes::findIdentity($params['id']);
        if ($serviceType->id_sto !== $this->findUser()->id) {
            return $result = [
                'success' => 0,
                'message' => 'Access denied',
                'code' => 'user_not_owner',
            ];
        }
    }

    /**
     * @return array|null
     */
    public function validate()
    {
        $resultValidateUser = $this->validateUser();
        if (isset($resultValidateUser)) {
            return $resultValidateUser;
        }

        $resultValidateOwner = $this->validateOwner();
        if (isset($resultValidateOwner)) {
            return $resultValidateOwner;
        }
        return false;
    }

    /**
     * Renders the index view for the module
     * @return array
     */
    public function actionIndex()
    {
        $result = $this->validateUser();
        return $result;
    }

    /**
     * @return array
     */
    public function actionCreate()
    {
        $params = Yii::$app->request->bodyParams;
        $result = $this->validateUser();
        if ($result) {
            return $result;
        }

        $serviceType = new ServiceTypes();
        $serviceType->name = $params['serviceName'];
        $serviceType->id_sto = $params['idUser'];
        $serviceType->save();

        return $result = [
            'success' => 1,
            'message' => 'Service type created',
            'serviceType' => $serviceType->id,
            'payload' => $serviceType,
        ];
    }

    /**
     * @return array
     */
    public function actionUpdate()
    {
        $params = Yii::$app->request->bodyParams;

        $result = $this->validate();
        if ($result) {
            return $result;
        }

        $serviceType = ServiceTypes::findIdentity($params['id']);
        $serviceType->name = $params['serviceName'];
        $serviceType->save();
        return $result = [
            'success' => 1,
            'message' => 'Service type changed',
            'serviceType' => $serviceType->id,
            'payload' => $serviceType,
        ];
    }

    /**
     * @return array
     */
    public function actionView()
    {
        $params = Yii::$app->request->bodyParams;

        $serviceType = ServiceTypes::findIdentity($params['id']);
        if ($serviceType) {
            return $result = [
                'success' => 1,
                'serviceName' => $serviceType->name,
                'idSto' => $serviceType->id_sto,
            ];
        } else {
            return $result = [
                'success' => 0,
                'message' => 'service type is not exist',
                'code' => 'service_type_id_error'
            ];
        }
    }

    /**
     * @return array
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete()
    {
        $params = Yii::$app->request->bodyParams;

        $result = $this->validateUser();
        if ($result) {
            return $result;
        };

        $serviceType = ServiceTypes::findIdentity($params['id']);
        $serviceType->delete();
        return $result = [
            'success' => 1,
            'message' => 'Service type deleted',
        ];

    }
}
