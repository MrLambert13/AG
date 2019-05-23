<?php

namespace app\modules\api\controllers;

use app\models\CarEquips;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class CarEquipController extends ActiveController
{
    public $modelClass = CarEquips::class;

}
