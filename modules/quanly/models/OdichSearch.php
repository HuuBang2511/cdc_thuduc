<?php

namespace app\modules\quanly\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\quanly\models\Odich;

/**
 * OdichSearch represents the model behind the search form about `app\modules\quanly\models\Odich`.
 */
class OdichSearch extends Odich
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'loaiodich_id', 'bi_bandau', 'ci_bandau', 'hi_bandau', 'truonghoc_id', 'loaibenhdich_id', 'lophoc_id', 'tinhtrangxuly_id', 'sauxuly'], 'integer'],
            [['ca_benh', 'ngayphathien', 'ngaykiemtra', 'ngaydukien_kiemta', 'ngaybatdau_giamsat', 'nguoithuchien', 'dienthoai', 'nhandinh_gs'], 'safe'],
            [['odichmoi'], 'boolean'],
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
        $query = Odich::find()->where(['status' => 1]);

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
            'loaiodich_id' => $this->loaiodich_id,
            'ngayphathien' => $this->ngayphathien,
            'ngaykiemtra' => $this->ngaykiemtra,
            'ngaydukien_kiemta' => $this->ngaydukien_kiemta,
            'ngaybatdau_giamsat' => $this->ngaybatdau_giamsat,
            'bi_bandau' => $this->bi_bandau,
            'ci_bandau' => $this->ci_bandau,
            'hi_bandau' => $this->hi_bandau,
            'truonghoc_id' => $this->truonghoc_id,
            'loaibenhdich_id' => $this->loaibenhdich_id,
            'lophoc_id' => $this->lophoc_id,
            'odichmoi' => $this->odichmoi,
            'tinhtrangxuly_id' => $this->tinhtrangxuly_id,
            'sauxuly' => $this->sauxuly,
        ]);

        $query->andFilterWhere(['ilike', 'ca_benh', mb_strtoupper($this->ca_benh)])
            ->andFilterWhere(['ilike', 'nguoithuchien', mb_strtoupper($this->nguoithuchien)])
            ->andFilterWhere(['ilike', 'dienthoai', mb_strtoupper($this->dienthoai)])
            ->andFilterWhere(['ilike', 'nhandinh_gs', mb_strtoupper($this->nhandinh_gs)]);

        return $dataProvider;
    }

    public function getExportColumns()
    {
        return [
            [
                'class' => 'kartik\grid\SerialColumn',
            ],
            'id',
            'ca_benh',
            'loaiodich_id',
            'ngayphathien',
            'ngaykiemtra',
            'ngaydukien_kiemta',
            'ngaybatdau_giamsat',
            'bi_bandau',
            'ci_bandau',
            'hi_bandau',
            'nguoithuchien',
            'dienthoai',
            'nhandinh_gs',
            'truonghoc_id',
            'loaibenhdich_id',
            'lophoc_id',
            'odichmoi',
            'tinhtrangxuly_id',
            'sauxuly',        
                ];
    }
}
