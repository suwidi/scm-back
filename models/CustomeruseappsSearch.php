<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Customeruseapps;

/**
 * CustomeruseappsSearch represents the model behind the search form about `backend\models\Customeruseapps`.
 */
class CustomeruseappsSearch extends Customeruseapps
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'id', 'customer_id'], 'integer'],
            [['companyname', 'status', 'orderplan', 'orderfrom', 'orderkey', 'created', 'creator', 'edited', 'editor', 'companycode', 'dbipaddress', 'dbname', 'dbusername', 'dbpassword'], 'safe'],
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
        $query = Customeruseapps::find();

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
            'id' => $this->id,
            'customer_id' => $this->customer_id,
        ]);

        $query->andFilterWhere(['like', 'companyname', $this->companyname])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'orderplan', $this->orderplan])
            ->andFilterWhere(['like', 'orderfrom', $this->orderfrom])
            ->andFilterWhere(['like', 'orderkey', $this->orderkey])
            ->andFilterWhere(['like', 'creator', $this->creator])
            ->andFilterWhere(['like', 'editor', $this->editor])
            ->andFilterWhere(['like', 'companycode', $this->companycode])
            ->andFilterWhere(['like', 'dbipaddress', $this->dbipaddress])
            ->andFilterWhere(['like', 'dbname', $this->dbname])
            ->andFilterWhere(['like', 'dbusername', $this->dbusername])
            ->andFilterWhere(['like', 'dbpassword', $this->dbpassword]);

        return $dataProvider;
    }
}
