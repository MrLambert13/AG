<?php

namespace app\modules\api\controllers;

use app\models\Vehicles;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class VehicleController extends ActiveController
{
    public $modelClass = Vehicles::class;

}
