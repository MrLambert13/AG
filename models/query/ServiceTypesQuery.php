<?php

namespace app\models\query;

use app\models\ServiceTypes;
use yii\db\ActiveQuery;

/**
 * This is the ActiveQuery class for [[\app\models\ServiceTypes]].
 * @see ServiceTypes
 */
class ServiceTypesQuery extends ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ServiceTypes[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ServiceTypes|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
