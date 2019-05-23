<?php

namespace app\modules\api\controllers;

use app\models\Motors;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class MotorController extends ActiveController
{
    public $modelClass = Motors::class;

}
