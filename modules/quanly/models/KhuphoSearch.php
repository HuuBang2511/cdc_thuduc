<?php

namespace app\modules\quanly\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\quanly\models\Khupho;

/**
 * KhuphoSearch represents the model behind the search form about `app\modules\quanly\models\Khupho`.
 */
class KhuphoSearch extends Khupho
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_by', 'updated_by', 'phuongxa_id', 'id_khupho'], 'integer'],
            [['ten_dvhc', 'ma_dvhc', 'geom', 'created_at', 'updated_at', 'maphuong'], 'safe'],
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
        $query = Khupho::find()->where(['status' => 1]);

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
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'phuongxa_id' => $this->phuongxa_id,
            'id_khupho' => $this->id_khupho,
        ]);

        $query->andFilterWhere(['ilike', 'ten_dvhc', mb_strtoupper($this->ten_dvhc)])
            ->andFilterWhere(['ilike', 'ma_dvhc', mb_strtoupper($this->ma_dvhc)])
            ->andFilterWhere(['ilike', 'geom', mb_strtoupper($this->geom)])
            ->andFilterWhere(['ilike', 'maphuong', mb_strtoupper($this->maphuong)]);

        return $dataProvider;
    }

    public function getExportColumns()
    {
        return [
            [
                'class' => 'kartik\grid\SerialColumn',
            ],
            'id',
            'ten_dvhc',
            'ma_dvhc',
            'geom',
            'status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'maphuong',
            'phuongxa_id',
            'id_khupho',        
                ];
    }
}
