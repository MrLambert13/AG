<?php

namespace app\modules\api\controllers;

use app\models\Sto;
use Yii;
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
        return Sto::find();
    }

    public function actionCreate()
    {
        $params = Yii::$app->request->bodyParams;
        return $params;
    }
}
