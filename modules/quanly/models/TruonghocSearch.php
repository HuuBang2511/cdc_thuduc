<?php

namespace app\modules\quanly\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\quanly\models\Truonghoc;

/**
 * TruonghocSearch represents the model behind the search form about `app\modules\quanly\models\Truonghoc`.
 */
class TruonghocSearch extends Truonghoc
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['gid', 'checked'], 'integer'],
            [['geom', 'dia_chi', 'ten_duong', 'ten_phuong', 'ten_quan', 'dien_thoai', 'ten_dv', 'ma_truong', 'ten_mien', 'doi_tuong', 'gd_cu', 'created_at', 'updated_at', 'maphuong', 'maquan'], 'safe'],
            [['objectid', 'x', 'y', 'phong_hoc', 'lop_hoc', 'giao_vien', 'hoc_sinh'], 'number'],
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
        $query = Truonghoc::find();

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
            'gid' => $this->gid,
            'objectid' => $this->objectid,
            'x' => $this->x,
            'y' => $this->y,
            'checked' => $this->checked,
            'phong_hoc' => $this->phong_hoc,
            'lop_hoc' => $this->lop_hoc,
            'giao_vien' => $this->giao_vien,
            'hoc_sinh' => $this->hoc_sinh,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['ilike', 'geom', mb_strtoupper($this->geom)])
            ->andFilterWhere(['ilike', 'dia_chi', mb_strtoupper($this->dia_chi)])
            ->andFilterWhere(['ilike', 'ten_duong', mb_strtoupper($this->ten_duong)])
            ->andFilterWhere(['ilike', 'ten_phuong', mb_strtoupper($this->ten_phuong)])
            ->andFilterWhere(['ilike', 'ten_quan', mb_strtoupper($this->ten_quan)])
            ->andFilterWhere(['ilike', 'dien_thoai', mb_strtoupper($this->dien_thoai)])
            ->andFilterWhere(['ilike', 'ten_dv', mb_strtoupper($this->ten_dv)])
            ->andFilterWhere(['ilike', 'ma_truong', mb_strtoupper($this->ma_truong)])
            ->andFilterWhere(['ilike', 'ten_mien', mb_strtoupper($this->ten_mien)])
            ->andFilterWhere(['ilike', 'doi_tuong', mb_strtoupper($this->doi_tuong)])
            ->andFilterWhere(['ilike', 'gd_cu', mb_strtoupper($this->gd_cu)])
            ->andFilterWhere(['ilike', 'maphuong', mb_strtoupper($this->maphuong)])
            ->andFilterWhere(['ilike', 'maquan', mb_strtoupper($this->maquan)]);

        return $dataProvider;
    }

    public function getExportColumns()
    {
        return [
            [
                'class' => 'kartik\grid\SerialColumn',
            ],
            'gid',
            'geom',
            'objectid',
            'dia_chi',
            'ten_duong',
            'ten_phuong',
            'ten_quan',
            'dien_thoai',
            'ten_dv',
            'ma_truong',
            'ten_mien',
            'x',
            'y',
            'doi_tuong',
            'gd_cu',
            'checked',
            'phong_hoc',
            'lop_hoc',
            'giao_vien',
            'hoc_sinh',
            'created_at',
            'updated_at',
            'maphuong',
            'maquan',        
                ];
    }
}
