<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Notification;

/**
 * NotificationSearch represents the model behind the search form about `common\models\Notification`.
 */
class NotificationSearch extends Notification
{
    public $card;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'card_id'], 'integer'],
            [['title', 'description'], 'safe'],
            [['card'], 'safe'],
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
        $query = Notification::find();

        $query->joinWith(['card']);
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 50,
            ],
            'sort'=> ['defaultOrder' => ['created_at'=>SORT_DESC]],
        ]);
        /*$dataProvider->sort->attributes['card'] = [
                'asc' => ['card.name' => SORT_ASC],
                'desc' => ['card.name' => SORT_DESC],
            ];*/
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'card_id' => $this->card_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'card.name', $this->card]);;

        return $dataProvider;
    }
}
