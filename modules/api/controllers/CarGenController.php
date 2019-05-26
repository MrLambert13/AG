<?php

namespace app\modules\api\controllers;

use app\models\CarGens;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class CarGenController extends ActiveController
{
    public $modelClass = CarGens::class;

}
