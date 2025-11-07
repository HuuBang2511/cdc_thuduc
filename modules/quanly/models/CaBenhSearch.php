<?php

namespace app\modules\quanly\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\quanly\models\CaBenh;
use app\modules\services\UtilityService;
use yii\helpers\ArrayHelper;

/**
 * CabenhSearch represents the model behind the search form about `app\modules\quanly\models\Cabenh`.
 */
class CabenhSearch extends Cabenh
{
    /**
     * @inheritdoc
     */

     public $date_from;
    public $date_to;

    public function rules()
    {
        return [
            [['id', 'loaibenh_id', 'gioitinh_id', 'tuanthai', 'khupho_noilamviec_id', 'khupho_noiohientai_id', 'chandoanchinh_id', 'somuitiem', 'tinhthanh_donvibaocao_id', 'tenduong_id', 'truonghoc_id', 'truonghoc_khupho_id', 'cabenhtrung_id', 'thangbaocao', 'stt', 'dantoc_id', 'tinhthanh_noilamviec_id', 'tinhthanh_noiohientai_id', 'tinhthanh_cosodieutri_id', 'namnhapvien', 'tinhthanh_xacminh_cabenh_id', 'phuongxa_xacminh_cabenh_id', 'khupho_xacminh_cabenh_id', 'loaicabenh_id', 'lophoc_id', 'songuoi_tronggiadinh_sxh', 'songuoi_duoi15_sxh', 'songuoi_giadinh_macbenh', 'songuoi_giadinh_macbenh_duoi15', 'status', 'created_by', 'updated_by', 'benhvien_id', 'chandoan_bandau_id', 'cachidiem_id', 'namnhanve', 'songuoi_cutrru_giadinh', 'songuoi_cutru_giadinh_duoi15', 'tenduong_benhnoikhac_id', 'khupho_benhnoikhac_id', 'songuoi_bi_tcm_giadinh', 'songuoi_bi_tcm_giadinh_duoi15', 'sotogiapranh_khaosat_tcm', 'sotokhaosat_tcm', 'loaiodich__id', 'soca_khaosat_tcm_benhsxh', 'dieutra_tcm_truonghoc_id'], 'integer'],
            [['mabenhnhan', 'hoten', 'ngaysinh', 'madinhdanh', 'ten_nguoibaoho', 'sodienthoai', 'nghenghiep', 'noilamviec', 'diachi_noilamviec', 'diachi_noiohientai', 'so_hsba', 'coso_dieutri', 'hinhthuc_dieutri', 'phandobenh', 'chandoan_bienchung', 'doanbenhkem', 'benhnen', 'ngaykhoiphat', 'ngaynhapvien', 'ngay_xuatvien_chuyenvien_tuvong', 'phanloai_chandoan', 'loaibenhpham', 'ngaylaymau', 'loaixetnghiem', 'ketqua_xetnghiem', 'tinhtrang_tiemchung', 'tiensu_dichte', 'nguoi_dieutra_dichte', 'sdt_nguoi_dieutra_dichte', 'donvi_dieutra', 'ngay_dieutra_dichte', 'email_donvidieutra', 'donvi_baocao', 'ngaybaocao', 'nguoibaocao', 'sdt_nguoibaocao', 'email_nguoibaocao', 'trangthai_baocao', 'danhsach_coso_dieutri', 'ngay_chinhsua_gannhat', 'ngaycapnhat', 'phanloai_cabenh', 'ngaygop_trung_cabenh', 'so_nha', 'ten_duong', 'ngaymacbenh', 'loai_ca_benh', 'thongtin_dieutri', 'ghichu', 'tinhtrang_hiennay', 'ngaynhanve', 'xacminh_cabenh', 'diachi_xacminh_cabenh', 'noikhac_xacminh_cabenh', 'ngaykhoibenh', 'ngaythongbao_cabenh', 'noichandoan', 'phuongxa_noiohientai', 'phuongxa_noilamviec', 'phuongxa_sausapnhap', 'phuongxa', 'truonghoc_phuongxa', 'ketluan_tinhtrang', 'ketluan_chandoan', 'ketluan_ngayxuatvien', 'ketluan_benhkhac', 'phuongxa_truonghoc', 'phuongxa_xacminhcabenh', 'donvi_thuchien_xetnghiem', 'created_at', 'updated_at', 'xacminh_chandoan', 'xacminh_xuly', 'sonha_benhnoikhac', 'phuongxa_benhnoikhac', 'noikhac_chitiet', 'trong_haituan_bisxh', 'trong1thang_tiepxuc_tcm_truonghoc', 'chitiet_denkhudongnguoi', 'chitiet_tacnhan_tiepxuc_tcm', 'nguonnuoc_sudung_tcm', 'chitiet_anchung_tre_nghingo_tcm', 'chitiet_dungdochoichung_tre_nghingo_tcm', 'chitiet_dungchung_vatdung_tre_nghingo_tcm', 'trong1thang_tiepxuc_giadinh_tcm', 'tinhtrang_dieutra', 'ngayhandieutra', 'tiendo_dieutra', 'khupho_sxhtp', 'tenduong_sxhtp', 'kp', 'duong', 'khuphonoikhac_sxhtp', 'duongnoikhac_sxhtp', 'tenbenhviennhap_sxhtp', 'xuly_ngay', 'benhvien_sxhtp'], 'safe'],
            [['cothai', 'laymau_xetnghiem', 'tinhtrang_xuatvien', 'cutru_tainha', 'nha_cabenh', 'nhaco_benhnhan_sxh', 'nhaco_nguoibenh', 'benhvien_phongkham', 'nhatho', 'dinhchua', 'congvien', 'noihoihop', 'noixaydung', 'quancaphe', 'noichannuoi', 'noibancaycanh', 'vuaphelieu', 'noikhac', 'cabenhchidiem', 'dietlangquang', 'giamsat_theodoi', 'xuly_odich_nho', 'cabenhthuphat', 'odichmoi', 'px_daden', 'pxkhac_daden', 'tinhtrangxuatvien', 'tamtru', 'benhnoikhac', 'thanhpho_baove', 'phathien_congdong', 'conhapvien', 'xuly_odich_dienrong', 'cadautien', 'codiachi', 'tiepxuc_tcm', 'dinhatre_tcm', 'tiepxuc_nguoichamsoc_tcm', 'denkhudongnguoi_tcm', 'tiepxuc_tacnhan_gaynhiem_tcm', 'anchung_tre_nghingo_tcm', 'dungdochoi_chung_tre_nghingo_tcm', 'dungchung_vatdung_tre_nghingo_tcm', 'khaosat_tcm_cocabenh_sxh', 'dieutra_tcm_codihoc', 'is_dieutra', 'nha_couongthuoc_sxh', 'odichcu', 'odichcu_xuly', 'xuly'], 'boolean'],
            [['bi_bandau', 'ci_bandau'], 'number'],
             [['date_from', 'date_to'], 'safe'],
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
        $query = Cabenh::find()->where(['status' => 1]);

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
            'loaibenh_id' => $this->loaibenh_id,
            'ngaysinh' => $this->ngaysinh,
            'gioitinh_id' => $this->gioitinh_id,
            'cothai' => $this->cothai,
            'tuanthai' => $this->tuanthai,
            'khupho_noilamviec_id' => $this->khupho_noilamviec_id,
            'khupho_noiohientai_id' => $this->khupho_noiohientai_id,
            'chandoanchinh_id' => $this->chandoanchinh_id,
            'ngaykhoiphat' => $this->ngaykhoiphat,
            'ngaynhapvien' => $this->ngaynhapvien,
            'ngay_xuatvien_chuyenvien_tuvong' => $this->ngay_xuatvien_chuyenvien_tuvong,
            'laymau_xetnghiem' => $this->laymau_xetnghiem,
            'somuitiem' => $this->somuitiem,
            'ngay_dieutra_dichte' => $this->ngay_dieutra_dichte,
            'tinhthanh_donvibaocao_id' => $this->tinhthanh_donvibaocao_id,
            'ngaybaocao' => $this->ngaybaocao,
            'ngay_chinhsua_gannhat' => $this->ngay_chinhsua_gannhat,
            'ngaycapnhat' => $this->ngaycapnhat,
            'ngaygop_trung_cabenh' => $this->ngaygop_trung_cabenh,
            'tenduong_id' => $this->tenduong_id,
            'truonghoc_id' => $this->truonghoc_id,
            'truonghoc_khupho_id' => $this->truonghoc_khupho_id,
            'ngaymacbenh' => $this->ngaymacbenh,
            'cabenhtrung_id' => $this->cabenhtrung_id,
            'thangbaocao' => $this->thangbaocao,
            'stt' => $this->stt,
            'dantoc_id' => $this->dantoc_id,
            'tinhthanh_noilamviec_id' => $this->tinhthanh_noilamviec_id,
            'tinhthanh_noiohientai_id' => $this->tinhthanh_noiohientai_id,
            'tinhthanh_cosodieutri_id' => $this->tinhthanh_cosodieutri_id,
            'ngaynhanve' => $this->ngaynhanve,
            'namnhapvien' => $this->namnhapvien,
            'tinhthanh_xacminh_cabenh_id' => $this->tinhthanh_xacminh_cabenh_id,
            'phuongxa_xacminh_cabenh_id' => $this->phuongxa_xacminh_cabenh_id,
            'khupho_xacminh_cabenh_id' => $this->khupho_xacminh_cabenh_id,
            'tinhtrang_xuatvien' => $this->tinhtrang_xuatvien,
            'loaicabenh_id' => $this->loaicabenh_id,
            'ngaykhoibenh' => $this->ngaykhoibenh,
            'lophoc_id' => $this->lophoc_id,
            'ngaythongbao_cabenh' => $this->ngaythongbao_cabenh,
            'cutru_tainha' => $this->cutru_tainha,
            'nha_cabenh' => $this->nha_cabenh,
            'songuoi_tronggiadinh_sxh' => $this->songuoi_tronggiadinh_sxh,
            'songuoi_duoi15_sxh' => $this->songuoi_duoi15_sxh,
            'nhaco_benhnhan_sxh' => $this->nhaco_benhnhan_sxh,
            'nhaco_nguoibenh' => $this->nhaco_nguoibenh,
            'benhvien_phongkham' => $this->benhvien_phongkham,
            'nhatho' => $this->nhatho,
            'dinhchua' => $this->dinhchua,
            'congvien' => $this->congvien,
            'noihoihop' => $this->noihoihop,
            'noixaydung' => $this->noixaydung,
            'quancaphe' => $this->quancaphe,
            'noichannuoi' => $this->noichannuoi,
            'noibancaycanh' => $this->noibancaycanh,
            'vuaphelieu' => $this->vuaphelieu,
            'noikhac' => $this->noikhac,
            'cabenhchidiem' => $this->cabenhchidiem,
            'dietlangquang' => $this->dietlangquang,
            'giamsat_theodoi' => $this->giamsat_theodoi,
            'xuly_odich_nho' => $this->xuly_odich_nho,
            'cabenhthuphat' => $this->cabenhthuphat,
            'odichmoi' => $this->odichmoi,
            'bi_bandau' => $this->bi_bandau,
            'ci_bandau' => $this->ci_bandau,
            'songuoi_giadinh_macbenh' => $this->songuoi_giadinh_macbenh,
            'songuoi_giadinh_macbenh_duoi15' => $this->songuoi_giadinh_macbenh_duoi15,
            'ketluan_ngayxuatvien' => $this->ketluan_ngayxuatvien,
            'px_daden' => $this->px_daden,
            'pxkhac_daden' => $this->pxkhac_daden,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'benhvien_id' => $this->benhvien_id,
            'chandoan_bandau_id' => $this->chandoan_bandau_id,
            'tinhtrangxuatvien' => $this->tinhtrangxuatvien,
            'tamtru' => $this->tamtru,
            'cachidiem_id' => $this->cachidiem_id,
            'namnhanve' => $this->namnhanve,
            'songuoi_cutrru_giadinh' => $this->songuoi_cutrru_giadinh,
            'songuoi_cutru_giadinh_duoi15' => $this->songuoi_cutru_giadinh_duoi15,
            'benhnoikhac' => $this->benhnoikhac,
            'tenduong_benhnoikhac_id' => $this->tenduong_benhnoikhac_id,
            'khupho_benhnoikhac_id' => $this->khupho_benhnoikhac_id,
            'thanhpho_baove' => $this->thanhpho_baove,
            'phathien_congdong' => $this->phathien_congdong,
            'conhapvien' => $this->conhapvien,
            'xuly_odich_dienrong' => $this->xuly_odich_dienrong,
            'cadautien' => $this->cadautien,
            'codiachi' => $this->codiachi,
            'tiepxuc_tcm' => $this->tiepxuc_tcm,
            'dinhatre_tcm' => $this->dinhatre_tcm,
            'tiepxuc_nguoichamsoc_tcm' => $this->tiepxuc_nguoichamsoc_tcm,
            'denkhudongnguoi_tcm' => $this->denkhudongnguoi_tcm,
            'tiepxuc_tacnhan_gaynhiem_tcm' => $this->tiepxuc_tacnhan_gaynhiem_tcm,
            'anchung_tre_nghingo_tcm' => $this->anchung_tre_nghingo_tcm,
            'dungdochoi_chung_tre_nghingo_tcm' => $this->dungdochoi_chung_tre_nghingo_tcm,
            'dungchung_vatdung_tre_nghingo_tcm' => $this->dungchung_vatdung_tre_nghingo_tcm,
            'songuoi_bi_tcm_giadinh' => $this->songuoi_bi_tcm_giadinh,
            'songuoi_bi_tcm_giadinh_duoi15' => $this->songuoi_bi_tcm_giadinh_duoi15,
            'sotogiapranh_khaosat_tcm' => $this->sotogiapranh_khaosat_tcm,
            'sotokhaosat_tcm' => $this->sotokhaosat_tcm,
            'loaiodich__id' => $this->loaiodich__id,
            'khaosat_tcm_cocabenh_sxh' => $this->khaosat_tcm_cocabenh_sxh,
            'soca_khaosat_tcm_benhsxh' => $this->soca_khaosat_tcm_benhsxh,
            'dieutra_tcm_codihoc' => $this->dieutra_tcm_codihoc,
            'dieutra_tcm_truonghoc_id' => $this->dieutra_tcm_truonghoc_id,
            'ngayhandieutra' => $this->ngayhandieutra,
            'is_dieutra' => $this->is_dieutra,
            'nha_couongthuoc_sxh' => $this->nha_couongthuoc_sxh,
            'odichcu' => $this->odichcu,
            'odichcu_xuly' => $this->odichcu_xuly,
            'xuly' => $this->xuly,
            'xuly_ngay' => $this->xuly_ngay,
        ]);

        $query->andFilterWhere(['ilike', 'mabenhnhan', mb_strtoupper($this->mabenhnhan)])
            ->andFilterWhere(['ilike', 'hoten', mb_strtoupper($this->hoten)])
            ->andFilterWhere(['ilike', 'madinhdanh', mb_strtoupper($this->madinhdanh)])
            ->andFilterWhere(['ilike', 'ten_nguoibaoho', mb_strtoupper($this->ten_nguoibaoho)])
            ->andFilterWhere(['ilike', 'sodienthoai', mb_strtoupper($this->sodienthoai)])
            ->andFilterWhere(['ilike', 'nghenghiep', mb_strtoupper($this->nghenghiep)])
            ->andFilterWhere(['ilike', 'noilamviec', mb_strtoupper($this->noilamviec)])
            ->andFilterWhere(['ilike', 'diachi_noilamviec', mb_strtoupper($this->diachi_noilamviec)])
            ->andFilterWhere(['ilike', 'diachi_noiohientai', mb_strtoupper($this->diachi_noiohientai)])
            ->andFilterWhere(['ilike', 'so_hsba', mb_strtoupper($this->so_hsba)])
            ->andFilterWhere(['ilike', 'coso_dieutri', mb_strtoupper($this->coso_dieutri)])
            ->andFilterWhere(['ilike', 'hinhthuc_dieutri', mb_strtoupper($this->hinhthuc_dieutri)])
            ->andFilterWhere(['ilike', 'phandobenh', mb_strtoupper($this->phandobenh)])
            ->andFilterWhere(['ilike', 'chandoan_bienchung', mb_strtoupper($this->chandoan_bienchung)])
            ->andFilterWhere(['ilike', 'doanbenhkem', mb_strtoupper($this->doanbenhkem)])
            ->andFilterWhere(['ilike', 'benhnen', mb_strtoupper($this->benhnen)])
            ->andFilterWhere(['ilike', 'phanloai_chandoan', mb_strtoupper($this->phanloai_chandoan)])
            ->andFilterWhere(['ilike', 'loaibenhpham', mb_strtoupper($this->loaibenhpham)])
            ->andFilterWhere(['ilike', 'ngaylaymau', mb_strtoupper($this->ngaylaymau)])
            ->andFilterWhere(['ilike', 'loaixetnghiem', mb_strtoupper($this->loaixetnghiem)])
            ->andFilterWhere(['ilike', 'ketqua_xetnghiem', mb_strtoupper($this->ketqua_xetnghiem)])
            ->andFilterWhere(['ilike', 'tinhtrang_tiemchung', mb_strtoupper($this->tinhtrang_tiemchung)])
            ->andFilterWhere(['ilike', 'tiensu_dichte', mb_strtoupper($this->tiensu_dichte)])
            ->andFilterWhere(['ilike', 'nguoi_dieutra_dichte', mb_strtoupper($this->nguoi_dieutra_dichte)])
            ->andFilterWhere(['ilike', 'sdt_nguoi_dieutra_dichte', mb_strtoupper($this->sdt_nguoi_dieutra_dichte)])
            ->andFilterWhere(['ilike', 'donvi_dieutra', mb_strtoupper($this->donvi_dieutra)])
            ->andFilterWhere(['ilike', 'email_donvidieutra', mb_strtoupper($this->email_donvidieutra)])
            ->andFilterWhere(['ilike', 'donvi_baocao', mb_strtoupper($this->donvi_baocao)])
            ->andFilterWhere(['ilike', 'nguoibaocao', mb_strtoupper($this->nguoibaocao)])
            ->andFilterWhere(['ilike', 'sdt_nguoibaocao', mb_strtoupper($this->sdt_nguoibaocao)])
            ->andFilterWhere(['ilike', 'email_nguoibaocao', mb_strtoupper($this->email_nguoibaocao)])
            ->andFilterWhere(['ilike', 'trangthai_baocao', mb_strtoupper($this->trangthai_baocao)])
            ->andFilterWhere(['ilike', 'danhsach_coso_dieutri', mb_strtoupper($this->danhsach_coso_dieutri)])
            ->andFilterWhere(['ilike', 'phanloai_cabenh', mb_strtoupper($this->phanloai_cabenh)])
            ->andFilterWhere(['ilike', 'so_nha', mb_strtoupper($this->so_nha)])
            ->andFilterWhere(['ilike', 'ten_duong', mb_strtoupper($this->ten_duong)])
            ->andFilterWhere(['ilike', 'loai_ca_benh', mb_strtoupper($this->loai_ca_benh)])
            ->andFilterWhere(['ilike', 'thongtin_dieutri', mb_strtoupper($this->thongtin_dieutri)])
            ->andFilterWhere(['ilike', 'ghichu', mb_strtoupper($this->ghichu)])
            ->andFilterWhere(['ilike', 'tinhtrang_hiennay', mb_strtoupper($this->tinhtrang_hiennay)])
            ->andFilterWhere(['ilike', 'xacminh_cabenh', mb_strtoupper($this->xacminh_cabenh)])
            ->andFilterWhere(['ilike', 'diachi_xacminh_cabenh', mb_strtoupper($this->diachi_xacminh_cabenh)])
            ->andFilterWhere(['ilike', 'noikhac_xacminh_cabenh', mb_strtoupper($this->noikhac_xacminh_cabenh)])
            ->andFilterWhere(['ilike', 'noichandoan', mb_strtoupper($this->noichandoan)])
            ->andFilterWhere(['ilike', 'phuongxa_noiohientai', mb_strtoupper($this->phuongxa_noiohientai)])
            ->andFilterWhere(['ilike', 'phuongxa_noilamviec', mb_strtoupper($this->phuongxa_noilamviec)])
            ->andFilterWhere(['ilike', 'phuongxa_sausapnhap', mb_strtoupper($this->phuongxa_sausapnhap)])
            ->andFilterWhere(['ilike', 'phuongxa', mb_strtoupper($this->phuongxa)])
            ->andFilterWhere(['ilike', 'truonghoc_phuongxa', mb_strtoupper($this->truonghoc_phuongxa)])
            ->andFilterWhere(['ilike', 'ketluan_tinhtrang', mb_strtoupper($this->ketluan_tinhtrang)])
            ->andFilterWhere(['ilike', 'ketluan_chandoan', mb_strtoupper($this->ketluan_chandoan)])
            ->andFilterWhere(['ilike', 'ketluan_benhkhac', mb_strtoupper($this->ketluan_benhkhac)])
            ->andFilterWhere(['ilike', 'phuongxa_truonghoc', mb_strtoupper($this->phuongxa_truonghoc)])
            ->andFilterWhere(['ilike', 'phuongxa_xacminhcabenh', mb_strtoupper($this->phuongxa_xacminhcabenh)])
            ->andFilterWhere(['ilike', 'donvi_thuchien_xetnghiem', mb_strtoupper($this->donvi_thuchien_xetnghiem)])
            ->andFilterWhere(['ilike', 'xacminh_chandoan', mb_strtoupper($this->xacminh_chandoan)])
            ->andFilterWhere(['ilike', 'xacminh_xuly', mb_strtoupper($this->xacminh_xuly)])
            ->andFilterWhere(['ilike', 'sonha_benhnoikhac', mb_strtoupper($this->sonha_benhnoikhac)])
            ->andFilterWhere(['ilike', 'phuongxa_benhnoikhac', mb_strtoupper($this->phuongxa_benhnoikhac)])
            ->andFilterWhere(['ilike', 'noikhac_chitiet', mb_strtoupper($this->noikhac_chitiet)])
            ->andFilterWhere(['ilike', 'trong_haituan_bisxh', mb_strtoupper($this->trong_haituan_bisxh)])
            ->andFilterWhere(['ilike', 'trong1thang_tiepxuc_tcm_truonghoc', mb_strtoupper($this->trong1thang_tiepxuc_tcm_truonghoc)])
            ->andFilterWhere(['ilike', 'chitiet_denkhudongnguoi', mb_strtoupper($this->chitiet_denkhudongnguoi)])
            ->andFilterWhere(['ilike', 'chitiet_tacnhan_tiepxuc_tcm', mb_strtoupper($this->chitiet_tacnhan_tiepxuc_tcm)])
            ->andFilterWhere(['ilike', 'nguonnuoc_sudung_tcm', mb_strtoupper($this->nguonnuoc_sudung_tcm)])
            ->andFilterWhere(['ilike', 'chitiet_anchung_tre_nghingo_tcm', mb_strtoupper($this->chitiet_anchung_tre_nghingo_tcm)])
            ->andFilterWhere(['ilike', 'chitiet_dungdochoichung_tre_nghingo_tcm', mb_strtoupper($this->chitiet_dungdochoichung_tre_nghingo_tcm)])
            ->andFilterWhere(['ilike', 'chitiet_dungchung_vatdung_tre_nghingo_tcm', mb_strtoupper($this->chitiet_dungchung_vatdung_tre_nghingo_tcm)])
            ->andFilterWhere(['ilike', 'trong1thang_tiepxuc_giadinh_tcm', mb_strtoupper($this->trong1thang_tiepxuc_giadinh_tcm)])
            ->andFilterWhere(['ilike', 'tinhtrang_dieutra', mb_strtoupper($this->tinhtrang_dieutra)])
            ->andFilterWhere(['ilike', 'tiendo_dieutra', mb_strtoupper($this->tiendo_dieutra)])
            ->andFilterWhere(['ilike', 'khupho_sxhtp', mb_strtoupper($this->khupho_sxhtp)])
            ->andFilterWhere(['ilike', 'tenduong_sxhtp', mb_strtoupper($this->tenduong_sxhtp)])
            ->andFilterWhere(['ilike', 'kp', mb_strtoupper($this->kp)])
            ->andFilterWhere(['ilike', 'duong', mb_strtoupper($this->duong)])
            ->andFilterWhere(['ilike', 'khuphonoikhac_sxhtp', mb_strtoupper($this->khuphonoikhac_sxhtp)])
            ->andFilterWhere(['ilike', 'duongnoikhac_sxhtp', mb_strtoupper($this->duongnoikhac_sxhtp)])
            ->andFilterWhere(['ilike', 'tenbenhviennhap_sxhtp', mb_strtoupper($this->tenbenhviennhap_sxhtp)])
            ->andFilterWhere(['ilike', 'benhvien_sxhtp', mb_strtoupper($this->benhvien_sxhtp)]);

        if($this->date_from != null && $this->date_to != null){
            $query->andFilterWhere(['between', 'ngaybaocao', UtilityService::convertDateFromMaskedInput($this->date_from), UtilityService::convertDateFromMaskedInput($this->date_to)]);
        }
        
        return $dataProvider;
    }

    public function getExportColumns()
    {
        return [
            [
                'class' => 'kartik\grid\SerialColumn',
            ],
            'id',
            'loaibenh_id',
            'mabenhnhan',
            'hoten',
            'ngaysinh',
            'gioitinh_id',
            'madinhdanh',
            'ten_nguoibaoho',
            'cothai',
            'sodienthoai',
            'tuanthai',
            'nghenghiep',
            'noilamviec',
            'diachi_noilamviec',
            'khupho_noilamviec_id',
            'diachi_noiohientai',
            'khupho_noiohientai_id',
            'so_hsba',
            'coso_dieutri',
            'hinhthuc_dieutri',
            'chandoanchinh_id',
            'phandobenh',
            'chandoan_bienchung',
            'doanbenhkem',
            'benhnen',
            'ngaykhoiphat',
            'ngaynhapvien',
            'ngay_xuatvien_chuyenvien_tuvong',
            'phanloai_chandoan',
            'laymau_xetnghiem',
            'loaibenhpham',
            'ngaylaymau',
            'loaixetnghiem',
            'ketqua_xetnghiem',
            'tinhtrang_tiemchung',
            'somuitiem',
            'tiensu_dichte',
            'nguoi_dieutra_dichte',
            'sdt_nguoi_dieutra_dichte',
            'donvi_dieutra',
            'ngay_dieutra_dichte',
            'email_donvidieutra',
            'donvi_baocao',
            'tinhthanh_donvibaocao_id',
            'ngaybaocao',
            'nguoibaocao',
            'sdt_nguoibaocao',
            'email_nguoibaocao',
            'trangthai_baocao',
            'danhsach_coso_dieutri',
            'ngay_chinhsua_gannhat',
            'ngaycapnhat',
            'phanloai_cabenh',
            'ngaygop_trung_cabenh',
            'so_nha',
            'ten_duong',
            'tenduong_id',
            'truonghoc_id',
            'truonghoc_khupho_id',
            'ngaymacbenh',
            'cabenhtrung_id',
            'thangbaocao',
            'loai_ca_benh',
            'stt',
            'dantoc_id',
            'tinhthanh_noilamviec_id',
            'tinhthanh_noiohientai_id',
            'tinhthanh_cosodieutri_id',
            'thongtin_dieutri',
            'ghichu',
            'tinhtrang_hiennay',
            'ngaynhanve',
            'namnhapvien',
            'xacminh_cabenh',
            'diachi_xacminh_cabenh',
            'tinhthanh_xacminh_cabenh_id',
            'phuongxa_xacminh_cabenh_id',
            'khupho_xacminh_cabenh_id',
            'noikhac_xacminh_cabenh',
            'tinhtrang_xuatvien',
            'loaicabenh_id',
            'ngaykhoibenh',
            'lophoc_id',
            'ngaythongbao_cabenh',
            'cutru_tainha',
            'nha_cabenh',
            'songuoi_tronggiadinh_sxh',
            'songuoi_duoi15_sxh',
            'nhaco_benhnhan_sxh',
            'nhaco_nguoibenh',
            'benhvien_phongkham',
            'nhatho',
            'dinhchua',
            'congvien',
            'noihoihop',
            'noixaydung',
            'quancaphe',
            'noichannuoi',
            'noibancaycanh',
            'vuaphelieu',
            'noikhac',
            'cabenhchidiem',
            'dietlangquang',
            'giamsat_theodoi',
            'xuly_odich_nho',
            'cabenhthuphat',
            'odichmoi',
            'noichandoan',
            'phuongxa_noiohientai',
            'phuongxa_noilamviec',
            'phuongxa_sausapnhap',
            'phuongxa',
            'truonghoc_phuongxa',
            'bi_bandau',
            'ci_bandau',
            'songuoi_giadinh_macbenh',
            'songuoi_giadinh_macbenh_duoi15',
            'ketluan_tinhtrang',
            'ketluan_chandoan',
            'ketluan_ngayxuatvien',
            'ketluan_benhkhac',
            'px_daden',
            'pxkhac_daden',
            'phuongxa_truonghoc',
            'phuongxa_xacminhcabenh',
            'donvi_thuchien_xetnghiem',
            'status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
            'benhvien_id',
            'chandoan_bandau_id',
            'xacminh_chandoan',
            'tinhtrangxuatvien',
            'xacminh_xuly',
            'tamtru',
            'cachidiem_id',
            'namnhanve',
            'songuoi_cutrru_giadinh',
            'songuoi_cutru_giadinh_duoi15',
            'benhnoikhac',
            'sonha_benhnoikhac',
            'tenduong_benhnoikhac_id',
            'phuongxa_benhnoikhac',
            'khupho_benhnoikhac_id',
            'noikhac_chitiet',
            'trong_haituan_bisxh',
            'thanhpho_baove',
            'phathien_congdong',
            'conhapvien',
            'xuly_odich_dienrong',
            'cadautien',
            'codiachi',
            'trong1thang_tiepxuc_tcm_truonghoc',
            'tiepxuc_tcm',
            'dinhatre_tcm',
            'tiepxuc_nguoichamsoc_tcm',
            'denkhudongnguoi_tcm',
            'chitiet_denkhudongnguoi',
            'tiepxuc_tacnhan_gaynhiem_tcm',
            'chitiet_tacnhan_tiepxuc_tcm',
            'nguonnuoc_sudung_tcm',
            'anchung_tre_nghingo_tcm',
            'chitiet_anchung_tre_nghingo_tcm',
            'dungdochoi_chung_tre_nghingo_tcm',
            'chitiet_dungdochoichung_tre_nghingo_tcm',
            'dungchung_vatdung_tre_nghingo_tcm',
            'chitiet_dungchung_vatdung_tre_nghingo_tcm',
            'trong1thang_tiepxuc_giadinh_tcm',
            'songuoi_bi_tcm_giadinh',
            'songuoi_bi_tcm_giadinh_duoi15',
            'sotogiapranh_khaosat_tcm',
            'sotokhaosat_tcm',
            'loaiodich__id',
            'khaosat_tcm_cocabenh_sxh',
            'soca_khaosat_tcm_benhsxh',
            'dieutra_tcm_codihoc',
            'dieutra_tcm_truonghoc_id',
            'tinhtrang_dieutra',
            'ngayhandieutra',
            'tiendo_dieutra',
            'is_dieutra',
            'khupho_sxhtp',
            'tenduong_sxhtp',
            'kp',
            'duong',
            'khuphonoikhac_sxhtp',
            'duongnoikhac_sxhtp',
            'tenbenhviennhap_sxhtp',
            'nha_couongthuoc_sxh',
            'odichcu',
            'odichcu_xuly',
            'xuly',
            'xuly_ngay',
            'benhvien_sxhtp',        
                ];
    }
}
