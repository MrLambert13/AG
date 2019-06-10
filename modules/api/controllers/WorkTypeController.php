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
class WorkTypeController extends Controller
{

    private $params;

    /**
     * @return Users|\yii\web\IdentityInterface|null
     */
    private function findUser()
    {
        return Users::findIdentity($this->params['idUser']);
    }

    /**
     * @return array
     */
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
        if (isset($this->params['id'])) {
            $workType = WorkTypes::findIdentity($this->params['id']);
            if ($workType->serviceType->id_sto !== $this->findUser()->id) {
                return $result = [
                    'success' => 0,
                    'message' => 'Access denied',
                    'code' => 'user_not_owner',
                ];
            }
        } else {
            $serviceType = ServiceTypes::findIdentity($this->params['idServiceType']);
            if ($serviceType->id_sto !== $this->findUser()->id) {
                return $result = [
                    'success' => 0,
                    'message' => 'Access denied',
                    'code' => 'user_not_owner',
                ];
            }
        }
    }

    /**
     * @return array|bool
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
        $result = $this->validate();
        if ($result) {
            return $result;
        }

        $workType = new WorkTypes();
        $workType->name = $this->params['workName'];
        $workType->id_service_type = $this->params['idServiceType'];

        if ($workType->save()) {
            return $result = [
                'success' => 1,
                'message' => 'Work type created',
                'workType' => $workType->id,
                'payload' => $workType,
            ];
        } else {
            return $result = [
                'success' => 0,
                'message' => 'Work type is not created',
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

        $workType = WorkTypes::findIdentity($this->params['id']);
        $workType->name = $this->params['workName'];
        if ($workType->save()) {
            return $result = [
                'success' => 1,
                'message' => 'Work type changed',
                'workType' => $workType->id,
                'payload' => $workType,
            ];
        } else {
            return $result = [
                'success' => 1,
                'message' => 'Work type is not changed',
                'code' => 'error_save',
            ];
        }
    }

    /**
     * @return array
     */
    public function actionView()
    {
        $workType = WorkTypes::findIdentity($this->params['id']);
        if ($workType) {
            return $result = [
                'success' => 1,
                'workName' => $workType->name,
                'idServiceType' => $workType->serviceType,
            ];
        } else {
            return $result = [
                'success' => 0,
                'message' => 'work type is not exist',
                'code' => 'work_type_id_error'
            ];
        }
    }

    public function actionAll()
    {
        $workType = WorkTypes::find()->select('name')->groupBy('name')->all();
        if ($workType) {
            return $workType;
        }
    }

    /**
     * @return array
     * @throws \Throwable
     * @throws StaleObjectException
     */
    public function actionDelete()
    {
        $result = $this->validate();
        if ($result) {
            return $result;
        };

        $workType = WorkTypes::findIdentity($this->params['id']);

        if ($workType->delete()) {
            return $result = [
                'success' => 1,
                'message' => 'Work type deleted',
            ];
        } else {
            return $result = [
                'success' => 0,
                'message' => 'Work category is not deleted',
                'code' => 'error_delete'
            ];
        }
    }
}
