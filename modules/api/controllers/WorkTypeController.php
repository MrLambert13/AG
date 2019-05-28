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

    /**
     * @return Users|\yii\web\IdentityInterface|null
     */
    private function findUser()
    {
        $params = Yii::$app->request->bodyParams;

        return Users::findIdentity($params['id_user']);
    }

    /**
     * @return array
     */
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
        $serviceType = WorkTypes::findIdentity($params['id'])->getServiceType();
        if ($serviceType->id_sto === $this->findUser()->id) {
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
        $result = $this->validate();
        return $result;
    }

    /**
     * @return array
     */
    public function actionCreate()
    {
        $params = Yii::$app->request->bodyParams;
        $result = $this->validate();
        if ($result) {
            return $result;
        }

        $workType = new ServiceTypes();
        $workType->name = $params['work_name'];
        $workType->id_sto = $params['user_id'];
        $workType->save();

        return $result = [
            'success' => 1,
            'message' => 'Work type created',
            'workType' => $workType->id,
            'payload' => $workType,
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

        $workType = WorkTypes::findIdentity($params['id']);
        $workType->name = $params['work_name'];
        $workType->save();
        return $result = [
            'success' => 1,
            'message' => 'Work type changed',
            'workType' => $workType->id,
            'payload' => $workType,
        ];
    }

    /**
     * @return array
     */
    public function actionView()
    {
        $params = Yii::$app->request->bodyParams;

        $workType = WorkTypes::findIdentity($params['id']);
        if ($workType) {
            return $result = [
                'success' => 1,
                'workName' => $workType->name,
                'idSto' => $workType->id_sto,
            ];
        } else {
            return $result = [
                'success' => 0,
                'message' => 'work type is not exist',
                'code' => 'work_type_id_error'
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

        $result = $this->validate();
        if ($result) {
            return $result;
        };

        $workType = WorkTypes::findIdentity($params['id']);
        $workType->delete();
        return $result = [
            'success' => 1,
            'message' => 'Work type deleted',
        ];

    }
}
