<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\MLpse;

/**
 * MLpseSearch represents the model behind the search form about `app\models\MLpse`.
 */
class MLpseSearch extends MLpse
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'cb', 'eb', 'id_lpse_inaproc'], 'integer'],
            [['cd', 'ed', 'name', 'link'], 'safe'],
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
        $query = MLpse::find();

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
            'id_lpse_inaproc' => $this->id_lpse_inaproc,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'link', $this->link]);

        return $dataProvider;
    }
}
