<?php

namespace app\modules\api\controllers;

use app\models\Sto;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class StoController extends ActiveController
{
    public $modelClass = Sto::class;

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return 'api-sto';
    }
}
