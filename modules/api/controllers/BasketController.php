<?php

namespace app\modules\api\controllers;

use app\models\Basket;
use Yii;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class BasketController extends ActiveController
{
    public $modelClass = Basket::class;
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

        $actions['index']['prepareDataProvider'] = [$this, 'prepareDataProvider'];

        return $actions;
    }

    public function prepareDataProvider()
    {
        $basket = Basket::find()->byUser($this->params['idUser']);
        $result = $basket
            ? [
                'success' => 1,
                'message' => 'Baskets finded',
                'payload' => $basket,
            ]
            : [
                'success' => 0,
                'message' => 'Baskets is not finded',
                'code' => 'error_find',
            ];
        return $result;
    }

}
