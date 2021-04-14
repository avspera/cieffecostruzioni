<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Automezzo;

/**
 * AutomezzoSearch represents the model behind the search form of `app\models\Automezzo`.
 */
class AutomezzoSearch extends Automezzo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['marca', 'modello', 'targa', 'created', 'data_immatricolazione', 'data_ultimo_rinnovo_assicurazione', 'data_scadenza_assicurazione', 'data_ultima_revisione', 'data_prossima_revisione'], 'safe'],
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
        $query = Automezzo::find();

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
        $query->andFilterWhere([
            'id' => $this->id,
            'created' => $this->created,
            'data_immatricolazione' => $this->data_immatricolazione,
            'data_ultimo_rinnovo_assicurazione' => $this->data_ultimo_rinnovo_assicurazione,
            'data_scadenza_assicurazione' => $this->data_scadenza_assicurazione,
            'data_ultima_revisione' => $this->data_ultima_revisione,
            'data_prossima_revisione' => $this->data_prossima_revisione,
        ]);

        $query->andFilterWhere(['like', 'marca', $this->marca])
            ->andFilterWhere(['like', 'modello', $this->modello])
            ->andFilterWhere(['like', 'targa', $this->targa]);

        return $dataProvider;
    }
}
