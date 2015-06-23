<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Customers;

/**
 * CustomersSearch represents the model behind the search form about `backend\models\Customers`.
 */
class CustomersSearch extends Customers
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['companycode', 'contactname', 'email', 'phone', 'address', 'city', 'zipcode', 'billingaddress', 'billingcity', 'billingzipcode', 'status', 'joiningdate', 'logo', 'created', 'creator', 'edited', 'editor'], 'safe'],
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
        $query = Customers::find();

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
            'joiningdate' => $this->joiningdate,
            'created' => $this->created,
            'edited' => $this->edited,
        ]);

        $query->andFilterWhere(['like', 'companycode', $this->companycode])
            ->andFilterWhere(['like', 'contactname', $this->contactname])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'address', $this->address])
            ->andFilterWhere(['like', 'city', $this->city])
            ->andFilterWhere(['like', 'zipcode', $this->zipcode])
            ->andFilterWhere(['like', 'billingaddress', $this->billingaddress])
            ->andFilterWhere(['like', 'billingcity', $this->billingcity])
            ->andFilterWhere(['like', 'billingzipcode', $this->billingzipcode])
            ->andFilterWhere(['like', 'status', $this->status])
            ->andFilterWhere(['like', 'logo', $this->logo])
            ->andFilterWhere(['like', 'creator', $this->creator])
            ->andFilterWhere(['like', 'editor', $this->editor]);

        return $dataProvider;
    }
}
