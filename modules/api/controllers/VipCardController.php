<?php

namespace app\modules\api\controllers;

use app\models\VipCards;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class VipCardController extends ActiveController
{
    public $modelClass = VipCards::class;
}
