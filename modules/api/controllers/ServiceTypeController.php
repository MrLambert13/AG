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

    private $params;
    
    /**
     * @return Users|\yii\web\IdentityInterface|null
     */
    private function findUser()
    {
        return Users::findIdentity($this->params['idUser']);
    }

    private function validateUser()
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
    private function validateOwner()
    {
        $serviceType = ServiceTypes::findIdentity($this->params['id']);
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
    private function validate()
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

    private function initParams()
    {
        $this->params = Yii::$app->request->bodyParams;
    }

    public function behaviors()
    {
        $this->initParams();
        return parent::behaviors();
    }
    
    /**
     * @return array
     */
    public function actionCreate()
    {
        $result = $this->validateUser();
        if ($result) {
            return $result;
        }

        $serviceType = new ServiceTypes();
        $serviceType->name = $this->params['serviceName'];
        $serviceType->id_sto = $this->params['idUser'];
        if ($serviceType->save()) {
            return $result = [
                'success' => 1,
                'message' => 'Service type created',
                'serviceType' => $serviceType->id,
                'payload' => $serviceType,
            ];
        } else {
            return $result = [
                'success' => 0,
                'message' => 'Service type is not created',
                'code' => 'error_save',
            ];
        }


    }

    /**
     * @return array
     */
    public function actionUpdate()
    {
        $result = $this->validate();
        if ($result) {
            return $result;
        }

        $serviceType = ServiceTypes::findIdentity($this->params['id']);
        $serviceType->name = $this->params['serviceName'];
        if ($serviceType->save()) {
            return $result = [
                'success' => 1,
                'message' => 'Service type changed',
                'serviceType' => $serviceType->id,
                'payload' => $serviceType,
            ];
        } else {
            return $result = [
                'success' => 0,
                'message' => 'Service type is not changed',
                'code' => 'error_save',
            ];
        }
    }

    /**
     * @return array
     */
    public function actionView()
    {
        $serviceType = ServiceTypes::findIdentity($this->params['id']);
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
        $result = $this->validateUser();
        if ($result) {
            return $result;
        };

        $serviceType = ServiceTypes::findIdentity($this->params['id']);
        if ($serviceType->delete()) {
            return $result = [
                'success' => 1,
                'message' => 'Service type deleted',
            ];
        } else {
            return $result = [
                'success' => 0,
                'message' => 'Service type is not deleted',
                'code' => 'error_delete'
            ];
        }
    }
}
