<?php

namespace app\modules\api\controllers;

use app\models\CarBrands;
use Yii;
use yii\rest\ActiveController;

/**
 * Default controller for the `api` module
 */
class CarBrandController extends ActiveController
{
    public $modelClass = CarBrands::class;

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['view']);
        return $actions;
    }

    public function actionView($id)
    {
        $model = CarBrands::findOne($id);
        return [
            $model,
            $model->carModels,
        ];
    }
}
