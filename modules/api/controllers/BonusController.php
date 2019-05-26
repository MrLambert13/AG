<?php

namespace app\modules\api\controllers;

use app\models\Bonuses;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class BonusController extends ActiveController
{
    public $modelClass = Bonuses::class;
}
