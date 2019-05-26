<?php

namespace app\modules\api\controllers;

use app\models\CarBrands;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class CarBrandController extends ActiveController
{
    public $modelClass = CarBrands::class;

}
