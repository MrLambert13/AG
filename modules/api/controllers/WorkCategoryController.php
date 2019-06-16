<?php

namespace app\modules\api\controllers;

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
            $workCategory = WorkCategories::findIdentity($this->params['id']);
            if ($workCategory->workType->serviceType->id_sto !== $this->findUser()->id) {
                return $result = [
                    'success' => 0,
                    'message' => 'Access denied',
                    'code' => 'user_not_owner',
                ];
            }
        } else {
            $workType = WorkTypes::findIdentity($this->params['idWorkType']);
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

        $workCategory = new WorkCategories();
        $workCategory->name = $this->params['workName'];
        $workCategory->id_work_type = $this->params['idWorkType'];
        $workCategory->cost = $this->params['cost'];
        if ($workCategory->save()) {
            return $result = [
                'success' => 1,
                'message' => 'Work category created',
                'workCategory' => $workCategory->id,
                'payload' => $workCategory,
            ];
        } else {
            return $result = [
                'success' => 0,
                'message' => 'Work category is not created',
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

        $workCategory = WorkCategories::findIdentity($this->params['id']);
        $workCategory->name = $this->params['workName'] ? $this->params['workName'] : $workCategory->name;
        $workCategory->cost = $this->params['cost'] ? $this->params['cost'] : $workCategory->cost;

        if ($workCategory->save()) {
            return $result = [
                'success' => 1,
                'message' => 'Work category changed',
                'workCategory' => $workCategory->id,
                'payload' => $workCategory,
            ];
        } else {
            return $result = [
                'success' => 0,
                'message' => 'Work category is not updated',
                'code' => 'error_save',
            ];
        }
    }

    /**
     * @return array
     */
    public function actionView()
    {
        $workCategory = WorkCategories::findIdentity($this->params['id']);
        if ($workCategory) {
            return $result = [
                'success' => 1,
                'workName' => $workCategory->name,
                'cost' => $workCategory->cost,
            ];
        } else {
            return $result = [
                'success' => 0,
                'message' => 'work category is not exist',
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
        $result = $this->validate();
        if ($result) {
            return $result;
        };

        $workType = WorkCategories::findIdentity($this->params['id']);
        if ($workType->delete()) {
            return $result = [
                'success' => 1,
                'message' => 'Work category deleted',
            ];
        } else {
            return $result = [
                'success' => 0,
                'message' => 'Work category is not deleted',
                'code' => 'error_delete'
            ];
        }
    }

    public function actionAll()
    {
        $workCategories = WorkCategories::find()->select(['id', 'name', 'cost'])->groupBy('name')->all();
        if ($workCategories) {
            return $workCategories;
        }
    }
}
