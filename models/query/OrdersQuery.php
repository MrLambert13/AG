<?php

namespace app\models\query;


use app\models\Orders;

/**
 * This is the ActiveQuery class for [[\app\models\Orders]].
 *
 * @see \app\models\Orders
 */
class OrdersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function byUser($idUser) {
        return $this->andWhere(['created_by' => $idUser])->all();
    }
    /**
     * {@inheritdoc}
     * @return \app\models\Orders[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Orders|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
