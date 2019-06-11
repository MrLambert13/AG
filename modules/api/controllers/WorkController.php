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
        $order = Orders::findOne($this->params['id']);
        if ($order) {
            $order->updated_by = $this->params['idUser'];
            $order->updated_at = time();
            if (isset($this->params['status'])) {
                $order->id_request_status = $this->params['status'];
            }
            if (isset($this->params['cost'])) {
                $order->final_cost = $this->params['cost'];
            }
            if (isset($this->params['completeDate'])) {
                $order->complete_date = $this->params['completeDate'];
            }

            $result = $order->save()
                ? [
                    'success' => 1,
                    'message' => 'Order updated',
                    'order' => $order->id,
                    'payload' => $order,
                ]
                : [
                    'success' => 0,
                    'message' => 'Order is not updated',
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
        $order = Orders::findOne($this->params['id']);
        $result = $order
            ? [
                'success' => 1,
                'message' => 'Order finded',
                'order' => $order->id,
                'payload' => $order,
            ]
            : [
                'success' => 0,
                'message' => 'Order is not finded',
                'code' => 'error_find',
            ];
        return $result;
    }

    public function actionDelete()
    {
        $order = Orders::findOne($this->params['id']);
        if ($order) {
            $result = $order->delete()
                ? [
                    'success' => 1,
                    'message' => 'Order deleted',
                ]
                : [
                    'success' => 0,
                    'message' => 'Order is not deleted',
                    'code' => 'error_delete',
                ];

            return $result;
        }
    }
    public function actionTest()
    {
        if (isset($this->params['idVehicle'])) {
            $result = $this->params['idVehicle'];
        }
        return $result;
//        return Orders::find()->byUser($this->params['idUser']);
    }

}
