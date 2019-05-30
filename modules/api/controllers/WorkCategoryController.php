<?php

namespace app\modules\api\controllers;

use app\models\ServiceTypes;
use app\models\Users;
use app\models\WorkCategories;
use app\models\WorkTypes;
use Yii;
use yii\db\StaleObjectException;
use yii\rest\Controller;

/**
 * Controller for CRUD services
 */
class WorkCategoryController extends Controller
{

    /**
     * @return Users|\yii\web\IdentityInterface|null
     */
    private function findUser()
    {
        $params = Yii::$app->request->bodyParams;

        return Users::findIdentity($params['idUser']);
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

        if (isset($params['id'])) {
            $workCategory = WorkCategories::findIdentity($params['id']);
            if ($workCategory->workType->serviceType->id_sto !== $this->findUser()->id) {
                return $result = [
                    'success' => 0,
                    'message' => 'Access denied',
                    'code' => 'user_not_owner',
                ];
            }
        } else {
            $workType = WorkTypes::findIdentity($params['idWorkType']);
            if ($workType->serviceType->id_sto !== $this->findUser()->id) {
                return $result = [
                    'success' => 0,
                    'message' => 'Access denied',
                    'code' => 'user_not_owner',
                ];
            }
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

        $workCategory = new WorkCategories();
        $workCategory->name = $params['workName'];
        $workCategory->id_work_type = $params['idWorkType'];
        $workCategory->cost = $params['cost'];
        $workCategory->save();

        return $result = [
            'success' => 1,
            'message' => 'Work type created',
            'workCategory' => $workCategory->id,
            'payload' => $workCategory,
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

        $workCategory = WorkCategories::findIdentity($params['id']);
        $workCategory->name = $params['workName'];
        $workCategory->save();
        return $result = [
            'success' => 1,
            'message' => 'Work type changed',
            'workCategory' => $workCategory->id,
            'payload' => $workCategory,
        ];
    }

    /**
     * @return array
     */
    public function actionView()
    {
        $params = Yii::$app->request->bodyParams;

        $workCategory = WorkCategories::findIdentity($params['id']);
        if ($workCategory) {
            return $result = [
                'success' => 1,
                'workName' => $workCategory->name,
                'cost' => $workCategory->cost,
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

        $workType = WorkCategories::findIdentity($params['id']);
        if ($workType->delete()) {
            return $result = [
                'success' => 1,
                'message' => 'Work category deleted',
            ];
        } else {
            return $result = [
                'success' => 0,
                'message' => 'Work category is not deleted',
                'code' => 'delete_error'
            ];
        }
    }
}
