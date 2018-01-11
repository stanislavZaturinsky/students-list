<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * StudentsSearch represents the model behind the search form of `app\models\Students`.
 */
class StudentsSearch extends Students
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'sex', 'points', 'birth_year', 'is_local'], 'integer'],
            [['first_name', 'last_name', 'group', 'email'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Students::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort'  => [
                'defaultOrder' => ['points' => SORT_DESC]
            ],
            'pagination' => [
                'pageSize' => 50
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id'         => $this->id,
            'sex'        => $this->sex,
            'points'     => $this->points,
            'birth_year' => $this->birth_year,
            'is_local'   => $this->is_local,
        ]);

        $query->andFilterWhere(['like', 'first_name', $this->first_name])
            ->andFilterWhere(['like', 'last_name', $this->last_name])
            ->andFilterWhere(['like', 'group', $this->group])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
