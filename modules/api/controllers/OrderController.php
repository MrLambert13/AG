<?php

namespace app\modules\api\controllers;

use app\models\Orders;
use app\models\RequestStatuses;
use app\models\ServiceTypes;
use app\models\Users;
use app\models\WorkTypes;
use Yii;
use yii\rest\Controller;

/**
 * Order controller for the `api` module
 */
class OrderController extends Controller
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

    public function actionCreate()
    {
        $order = new Orders();
        $order->id_city = $this->params['idCity'];
        $order->id_vehicle = $this->params['idVehicle'];
        $order->created_by = $this->params['idUser'];
        $order->created_at = time();
        $order->id_request_status = RequestStatuses::STATUS_CREATE;
        if ($order->save()) {
            return $result = [
                'success' => 1,
                'message' => 'Order created',
                'order' => $order->id,
                'payload' => $order,
            ];
        } else {
            return $result = [
                'success' => 0,
                'message' => 'Order is not created',
                'code' => 'error_save',
            ];
        }
    }

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

            $order->save()
                ? $result = [
                'success' => 1,
                'message' => 'Order created',
                'order' => $order->id,
                'payload' => $order,
            ]
                : $result = [
                'success' => 0,
                'message' => 'Order is not created',
                'code' => 'error_save',
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
