<?php

namespace app\models\query;

/**
 * This is the ActiveQuery class for [[\app\models\Basket]].
 * @see \app\models\Basket
 */
class BasketQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function byUser($idUser)
    {
        return $this->andWhere(['created_by' => $idUser])->all();
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Basket[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Basket|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
