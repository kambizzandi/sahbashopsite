<?php

namespace app\modules\panel\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\panel\models\BasketItemModel;

/**
 * BasketItemSearchModel represents the model behind the search form of `app\modules\panel\models\BasketItemModel`.
 */
class BasketItemSearchModel extends BasketItemModel
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            // [['basketItem_id', 'basketItem_price'], 'integer'],
            // [['basketItem_name'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = BasketItemModel::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        // $query->andFilterWhere([
        //     'basketItem_id' => $this->basketItem_id,
        //     'basketItem_price' => $this->basketItem_price,
        // ]);

        // $query->andFilterWhere(['like', 'basketItem_name', $this->basketItem_name]);

        return $dataProvider;
    }
}
