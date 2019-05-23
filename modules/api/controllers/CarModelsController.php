<?php

namespace app\modules\api\controllers;

use app\models\CarModels;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class CarModelsController extends ActiveController
{
    public $modelClass = CarModels::class;

}
