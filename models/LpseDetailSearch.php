<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\LpseDetail;

/**
 * LpseDetailSearch represents the model behind the search form about `backend\models\LpseDetail`.
 */
class LpseDetailSearch extends LpseDetail
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cb', 'eb', 'lpse_id', 'orig_lpse_id', 'orig_lelang_id'], 'integer'],
            [['cd', 'ed', 'name'], 'safe'],
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
        $query = LpseDetail::find();

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
            'orig_lpse_id' => $this->orig_lpse_id,
            'orig_lelang_id' => $this->orig_lelang_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
