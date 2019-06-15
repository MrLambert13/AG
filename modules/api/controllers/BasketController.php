<?php

namespace app\modules\api\controllers;

use app\models\Basket;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class BasketController extends ActiveController
{
    public $modelClass = Basket::class;

}
