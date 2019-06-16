<?php

namespace app\models\query;

use app\models\Users;

/**
 * This is the ActiveQuery class for [[\app\models\Users]].
 *
 * @see \app\models\Users
 */
class UsersQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    public function sto()
    {
        return $this->andWhere(['id_user_type' => Users::USER_TYPE_STO])->all();

    }

    /**
     * {@inheritdoc}
     * @return \app\models\Users[]|array
     */
    public function all($db = null)
    {
        return $this->sto();
    }

    /**
     * {@inheritdoc}
     * @return \app\models\Users|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
