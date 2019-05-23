<?php

namespace app\modules\api\controllers;

use app\models\CarModels;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class CarModelController extends ActiveController
{
    public $modelClass = CarModels::class;

}
