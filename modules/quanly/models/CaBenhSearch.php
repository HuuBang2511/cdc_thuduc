<?php

namespace app\modules\quanly\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\quanly\models\CaBenh;

/**
 * CaBenhSearch represents the model behind the search form about `app\modules\quanly\models\CaBenh`.
 */
class CaBenhSearch extends CaBenh
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'loaibenh_id', 'gioitinh_id', 'tuanthai', 'khupho_noilamviec_id', 'khupho_noiohientai_id', 'chandoanchinh_id', 'somuitiem', 'tinhthanh_donvibaocao_id', 'tenduong_id', 'truonghoc_id', 'truonghoc_khupho_id', 'cabenhtrung_id', 'thangbaocao', 'stt', 'dantoc_id', 'tinhthanh_noilamviec_id', 'tinhthanh_noiohientai_id', 'tinhthanh_cosodieutri_id', 'namnhapvien', 'tinhthanh_xacminh_cabenh_id', 'phuongxa_xacminh_cabenh_id', 'khupho_xacminh_cabenh_id', 'loaicabenh_id', 'lophoc_id', 'songuoi_tronggiadinh_sxh', 'songuoi_duoi15_sxh', 'songuoi_giadinh_macbenh', 'songuoi_giadinh_macbenh_duoi15', 'status', 'created_by', 'updated_by', 'benhvien_id', 'chandoan_bandau_id', 'cachidiem_id', 'namnhanve'], 'integer'],
            [['mabenhnhan', 'hoten', 'ngaysinh', 'madinhdanh', 'ten_nguoibaoho', 'sodienthoai', 'nghenghiep', 'noilamviec', 'diachi_noilamviec', 'diachi_noiohientai', 'so_hsba', 'coso_dieutri', 'hinhthuc_dieutri', 'phandobenh', 'chandoan_bienchung', 'doanbenhkem', 'benhnen', 'ngaykhoiphat', 'ngaynhapvien', 'ngay_xuatvien_chuyenvien_tuvong', 'phanloai_chandoan', 'loaibenhpham', 'ngaylaymau', 'loaixetnghiem', 'ketqua_xetnghiem', 'tinhtrang_tiemchung', 'tiensu_dichte', 'nguoi_dieutra_dichte', 'sdt_nguoi_dieutra_dichte', 'donvi_dieutra', 'ngay_dieutra_dichte', 'email_donvidieutra', 'donvi_baocao', 'ngaybaocao', 'nguoibaocao', 'sdt_nguoibaocao', 'email_nguoibaocao', 'trangthai_baocao', 'danhsach_coso_dieutri', 'ngay_chinhsua_gannhat', 'ngaycapnhat', 'phanloai_cabenh', 'ngaygop_trung_cabenh', 'so_nha', 'ten_duong', 'ngaymacbenh', 'loai_ca_benh', 'thongtin_dieutri', 'ghichu', 'tinhtrang_hiennay', 'ngaynhanve', 'xacminh_cabenh', 'diachi_xacminh_cabenh', 'noikhac_xacminh_cabenh', 'ngaykhoibenh', 'ngaythongbao_cabenh', 'noichandoan', 'phuongxa_noiohientai', 'phuongxa_noilamviec', 'phuongxa_sausapnhap', 'phuongxa', 'truonghoc_phuongxa', 'ketluan_tinhtrang', 'ketluan_chandoan', 'ketluan_ngayxuatvien', 'ketluan_benhkhac', 'phuongxa_truonghoc', 'phuongxa_xacminhcabenh', 'donvi_thuchien_xetnghiem', 'created_at', 'updated_at', 'xacminh_chandoan', 'xacminh_xuly'], 'safe'],
            [['cothai', 'laymau_xetnghiem', 'tinhtrang_xuatvien', 'cutru_tainha', 'nha_cabenh', 'nhaco_benhnhan_sxh', 'nhaco_nguoibenh', 'benhvien_phongkham', 'nhatho', 'dinhchua', 'congvien', 'noihoihop', 'noixaydung', 'quancaphe', 'noichannuoi', 'noibancaycanh', 'vuaphelieu', 'noikhac', 'cabenhchidiem', 'dietlangquang', 'giamsat_theodoi', 'xuly_odich_nho', 'cabenhthuphat', 'odichmoi', 'px_daden', 'pxkhac_daden', 'tinhtrangxuatvien', 'tamtru'], 'boolean'],
            [['bi_bandau', 'ci_bandau'], 'number'],
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
        $query = CaBenh::find()->where(['status' => 1]);

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
            'nguoibaocao' => $this->nguoibaocao,
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
        ]);

        $query->andFilterWhere(['like', 'upper(mabenhnhan)', mb_strtoupper($this->mabenhnhan)])
            ->andFilterWhere(['like', 'upper(hoten)', mb_strtoupper($this->hoten)])
            ->andFilterWhere(['like', 'upper(madinhdanh)', mb_strtoupper($this->madinhdanh)])
            ->andFilterWhere(['like', 'upper(ten_nguoibaoho)', mb_strtoupper($this->ten_nguoibaoho)])
            ->andFilterWhere(['like', 'upper(sodienthoai)', mb_strtoupper($this->sodienthoai)])
            ->andFilterWhere(['like', 'upper(nghenghiep)', mb_strtoupper($this->nghenghiep)])
            ->andFilterWhere(['like', 'upper(noilamviec)', mb_strtoupper($this->noilamviec)])
            ->andFilterWhere(['like', 'upper(diachi_noilamviec)', mb_strtoupper($this->diachi_noilamviec)])
            ->andFilterWhere(['like', 'upper(diachi_noiohientai)', mb_strtoupper($this->diachi_noiohientai)])
            ->andFilterWhere(['like', 'upper(so_hsba)', mb_strtoupper($this->so_hsba)])
            ->andFilterWhere(['like', 'upper(coso_dieutri)', mb_strtoupper($this->coso_dieutri)])
            ->andFilterWhere(['like', 'upper(hinhthuc_dieutri)', mb_strtoupper($this->hinhthuc_dieutri)])
            ->andFilterWhere(['like', 'upper(phandobenh)', mb_strtoupper($this->phandobenh)])
            ->andFilterWhere(['like', 'upper(chandoan_bienchung)', mb_strtoupper($this->chandoan_bienchung)])
            ->andFilterWhere(['like', 'upper(doanbenhkem)', mb_strtoupper($this->doanbenhkem)])
            ->andFilterWhere(['like', 'upper(benhnen)', mb_strtoupper($this->benhnen)])
            ->andFilterWhere(['like', 'upper(phanloai_chandoan)', mb_strtoupper($this->phanloai_chandoan)])
            ->andFilterWhere(['like', 'upper(loaibenhpham)', mb_strtoupper($this->loaibenhpham)])
            ->andFilterWhere(['like', 'upper(ngaylaymau)', mb_strtoupper($this->ngaylaymau)])
            ->andFilterWhere(['like', 'upper(loaixetnghiem)', mb_strtoupper($this->loaixetnghiem)])
            ->andFilterWhere(['like', 'upper(ketqua_xetnghiem)', mb_strtoupper($this->ketqua_xetnghiem)])
            ->andFilterWhere(['like', 'upper(tinhtrang_tiemchung)', mb_strtoupper($this->tinhtrang_tiemchung)])
            ->andFilterWhere(['like', 'upper(tiensu_dichte)', mb_strtoupper($this->tiensu_dichte)])
            ->andFilterWhere(['like', 'upper(nguoi_dieutra_dichte)', mb_strtoupper($this->nguoi_dieutra_dichte)])
            ->andFilterWhere(['like', 'upper(sdt_nguoi_dieutra_dichte)', mb_strtoupper($this->sdt_nguoi_dieutra_dichte)])
            ->andFilterWhere(['like', 'upper(donvi_dieutra)', mb_strtoupper($this->donvi_dieutra)])
            ->andFilterWhere(['like', 'upper(email_donvidieutra)', mb_strtoupper($this->email_donvidieutra)])
            ->andFilterWhere(['like', 'upper(donvi_baocao)', mb_strtoupper($this->donvi_baocao)])
            ->andFilterWhere(['like', 'upper(sdt_nguoibaocao)', mb_strtoupper($this->sdt_nguoibaocao)])
            ->andFilterWhere(['like', 'upper(email_nguoibaocao)', mb_strtoupper($this->email_nguoibaocao)])
            ->andFilterWhere(['like', 'upper(trangthai_baocao)', mb_strtoupper($this->trangthai_baocao)])
            ->andFilterWhere(['like', 'upper(danhsach_coso_dieutri)', mb_strtoupper($this->danhsach_coso_dieutri)])
            ->andFilterWhere(['like', 'upper(phanloai_cabenh)', mb_strtoupper($this->phanloai_cabenh)])
            ->andFilterWhere(['like', 'upper(so_nha)', mb_strtoupper($this->so_nha)])
            ->andFilterWhere(['like', 'upper(ten_duong)', mb_strtoupper($this->ten_duong)])
            ->andFilterWhere(['like', 'upper(loai_ca_benh)', mb_strtoupper($this->loai_ca_benh)])
            ->andFilterWhere(['like', 'upper(thongtin_dieutri)', mb_strtoupper($this->thongtin_dieutri)])
            ->andFilterWhere(['like', 'upper(ghichu)', mb_strtoupper($this->ghichu)])
            ->andFilterWhere(['like', 'upper(tinhtrang_hiennay)', mb_strtoupper($this->tinhtrang_hiennay)])
            ->andFilterWhere(['like', 'upper(xacminh_cabenh)', mb_strtoupper($this->xacminh_cabenh)])
            ->andFilterWhere(['like', 'upper(diachi_xacminh_cabenh)', mb_strtoupper($this->diachi_xacminh_cabenh)])
            ->andFilterWhere(['like', 'upper(noikhac_xacminh_cabenh)', mb_strtoupper($this->noikhac_xacminh_cabenh)])
            ->andFilterWhere(['like', 'upper(noichandoan)', mb_strtoupper($this->noichandoan)])
            ->andFilterWhere(['like', 'upper(phuongxa_noiohientai)', mb_strtoupper($this->phuongxa_noiohientai)])
            ->andFilterWhere(['like', 'upper(phuongxa_noilamviec)', mb_strtoupper($this->phuongxa_noilamviec)])
            ->andFilterWhere(['like', 'upper(phuongxa_sausapnhap)', mb_strtoupper($this->phuongxa_sausapnhap)])
            ->andFilterWhere(['like', 'upper(phuongxa)', mb_strtoupper($this->phuongxa)])
            ->andFilterWhere(['like', 'upper(truonghoc_phuongxa)', mb_strtoupper($this->truonghoc_phuongxa)])
            ->andFilterWhere(['like', 'upper(ketluan_tinhtrang)', mb_strtoupper($this->ketluan_tinhtrang)])
            ->andFilterWhere(['like', 'upper(ketluan_chandoan)', mb_strtoupper($this->ketluan_chandoan)])
            ->andFilterWhere(['like', 'upper(ketluan_benhkhac)', mb_strtoupper($this->ketluan_benhkhac)])
            ->andFilterWhere(['like', 'upper(phuongxa_truonghoc)', mb_strtoupper($this->phuongxa_truonghoc)])
            ->andFilterWhere(['like', 'upper(phuongxa_xacminhcabenh)', mb_strtoupper($this->phuongxa_xacminhcabenh)])
            ->andFilterWhere(['like', 'upper(donvi_thuchien_xetnghiem)', mb_strtoupper($this->donvi_thuchien_xetnghiem)])
            ->andFilterWhere(['like', 'upper(xacminh_chandoan)', mb_strtoupper($this->xacminh_chandoan)])
            ->andFilterWhere(['like', 'upper(xacminh_xuly)', mb_strtoupper($this->xacminh_xuly)]);

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
        'namnhanve',        ];
    }
}
