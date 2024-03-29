<?php

namespace common\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Question;
use yii\db\Expression;

/**
 * QuestionSearch represents the model behind the search form of `common\models\Question`.
 */
class QuestionSearch extends Question
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'questionnaire_id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['name'], 'safe'],
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
    public function search($params,$qre_id='',$r20='') //Random 20 = false by default // true
    {
        $query = Question::find();
        if($qre_id != ''){
			// echo 123; exit;
            $query = Question::find()->where(['questionnaire_id'=>$qre_id]); //->orderBy(new Expression('rand()'))
        }
        // add conditions that should always apply here  ---- ->orderBy(new Expression('rand()'))->limit(10)
		
		// rdm 13may 20 random rec only 
		// if($r20){  
 			// $query->orderBy(new Expression('rand()'))->limit(20);
		// }
		
		// echo "<pre>"; print_r(count($query->all())); exit;
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
			'pagination' => false, // pagination false rdm 13may
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'questionnaire_id' => $this->questionnaire_id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
