<?php

namespace app\modules\api\controllers;

use app\models\Garages;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class GarageController extends ActiveController
{
    public $modelClass = Garages::class;

}
