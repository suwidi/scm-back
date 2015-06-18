<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MLpseProfile;

/**
 * MLpseProfileSearch represents the model behind the search form about `backend\models\MLpseProfile`.
 */
class MLpseProfileSearch extends MLpseProfile
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cb', 'eb', 'lpse_id', 'profile_id'], 'integer'],
            [['cd', 'ed', 'value'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
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
        $query = MLpseProfile::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'cd' => $this->cd,
            'cb' => $this->cb,
            'ed' => $this->ed,
            'eb' => $this->eb,
            'lpse_id' => $this->lpse_id,
            'profile_id' => $this->profile_id,
        ]);

        $query->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
