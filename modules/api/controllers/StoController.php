<?php

namespace app\modules\api\controllers;

use app\models\Users;
use Yii;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class StoController extends ActiveController
{
    public $modelClass = Users::class;

    private $params;


    public function behaviors()
    {
        parent::behaviors();

        $this->initParams();
        return parent::behaviors();
    }

    private function initParams()
    {
        $this->params = Yii::$app->request->bodyParams;
    }

    public function actions()
    {
        $actions = parent::actions();

        unset($actions['delete'], $actions['create'], $actions['update'], $actions['view']);
        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        $sto = $this->modelClass::find()->sto();
        $result = $sto
            ? [
                'success' => 1,
                'message' => 'Sto finded',
                'payload' => $sto,
            ]
            : [
                'success' => 0,
                'message' => 'Sto is not finded',
                'code' => 'error_find',
            ];
        return $result;
    }

}
