<?php

namespace app\models\query;


use app\models\Users;
use yii\db\ActiveQuery;

class UserQuery extends ActiveQuery
{
    public function active()
    {
        return $this->andWhere(['status' => Users::STATUS_ACTIVE]);
    }

    public function all($db = null)
    {
        return parent::all($db);
    }

    public function one($db = null)
    {
        return parent::one($db);
    }
}