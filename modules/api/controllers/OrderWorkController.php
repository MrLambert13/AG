<?php

namespace app\modules\api\controllers;

use app\models\OrdersWorks;
use yii\rest\ActiveController;

/**
 * Order-work controller for the `api` module
 */
class OrderWorkController extends ActiveController
{
    public $modelClass = OrdersWorks::class;

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return 'Order work API';
    }

}
