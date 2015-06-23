<?php

namespace backend\Models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\Models\Orders;

/**
 * OrdersSearch represents the model behind the search form about `backend\Models\Orders`.
 */
class OrdersSearch extends Orders
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id'], 'integer'],
            [['fullname', 'companyname', 'email', 'phonenumber', 'orderapp', 'status', 'orderplan', 'orderfrom', 'orderkey', 'created', 'creator', 'edited', 'editor'], 'safe'],
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
        $query = Orders::find();

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
            'order_id' => $this->order_id,
            'created' => $this->created,
            'edited' => $this->edited,
        ]);

        $query->andFilterWhere(['like', 'fullname', $this->fullname])
            ->andFilterWhere(['like', 'companyname', $this->companyname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phonenumber', $this->phonenumber])
            ->andFilterWhere(['like', 'orderapp', $this->orderapp])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'orderplan', $this->orderplan])
            ->andFilterWhere(['like', 'orderfrom', $this->orderfrom])
            ->andFilterWhere(['like', 'orderkey', $this->orderkey])
            ->andFilterWhere(['like', 'creator', $this->creator])
            ->andFilterWhere(['like', 'editor', $this->editor]);

        return $dataProvider;
    }
}
