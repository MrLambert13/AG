<?php

namespace app\modules\api\controllers;

use app\models\Orders;
use app\models\RequestStatuses;
use app\models\ServiceTypes;
use app\models\Users;
use app\models\Works;
use app\models\WorkTypes;
use Yii;
use yii\rest\Controller;

/**
 * Work controller for the `api` module
 */
class WorkController extends Controller
{
    public $modelClass = Orders::class;

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
        $work = new Works();
        $work->id_service = $this->params['idService'];
        $work->id_work_type = $this->params['idWorkType'];
        $work->id_vehicle = $this->params['idVehicle'];
        $work->cost_service = $this->params['cost'];
        $work->created_by = $this->params['idUser'];
        $work->create_at = time();
        if ($work->save()) {
            return $result = [
                'success' => 1,
                'message' => 'Work created',
                'work' => $work->id,
                'payload' => $work,
            ];
        } else {
            return $result = [
                'success' => 0,
                'message' => 'Work is not created',
                'code' => 'error_save',
            ];
        }
    }

    /**
     * @return array
     */
    public function actionUpdate()
    {
        $work = Works::findOne($this->params['id']);
        if ($work) {
            if (isset($this->params['status'])) {
                $work->status = $this->params['status'];
            }
            if (isset($this->params['start'])) {
                $work->date_start = $this->params['start'];
            }
            if (isset($this->params['end'])) {
                $work->date_end = $this->params['end'];
            }

            $result = $work->save()
                ? [
                    'success' => 1,
                    'message' => 'Work updated',
                    'work' => $work->id,
                    'payload' => $work,
                ]
                : [
                    'success' => 0,
                    'message' => 'Work is not updated',
                    'code' => 'error_save',
                ];

            return $result;
        }
    }

    /**
     * @return array
     */
    public function actionView()
    {
        $work = Works::findOne($this->params['id']);
        $result = $work
            ? [
                'success' => 1,
                'message' => 'Work finded',
                'work' => $work->id,
                'payload' => $work,
            ]
            : [
                'success' => 0,
                'message' => 'Work is not finded',
                'code' => 'error_find',
            ];
        return $result;
    }

    public function actionDelete()
    {
        $work = Works::findOne($this->params['id']);
        if ($work) {
            $result = $work->delete()
                ? [
                    'success' => 1,
                    'message' => 'Work deleted',
                ]
                : [
                    'success' => 0,
                    'message' => 'Work is not deleted',
                    'code' => 'error_delete',
                ];

            return $result;
        }
    }
}
