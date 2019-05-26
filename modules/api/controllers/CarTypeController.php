<?php

namespace app\modules\api\controllers;

use app\models\CarTypes;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class CarTypeController extends ActiveController
{
    public $modelClass = CarTypes::class;
}
