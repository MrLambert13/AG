<?php


namespace app\models;


use yii\base\Model;
use yii\data\ActiveDataProvider;

class UserSearch extends Users
{
    public function rules()
    {
        return [
            [['username'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return Model::scenarios();
    }

    public function search($params)
    {
//        $query = Users::find()->active();
        $query = Users::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => ['id' => SORT_DESC],
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere(['like', 'username', $this->username]);

        return $dataProvider;
    }
}