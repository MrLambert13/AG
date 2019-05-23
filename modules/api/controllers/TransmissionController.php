<?php

namespace app\modules\api\controllers;

use app\models\Transmissions;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class TransmissionController extends ActiveController
{
    public $modelClass = Transmissions::class;

}
