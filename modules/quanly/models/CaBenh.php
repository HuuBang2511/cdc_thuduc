<?php

namespace app\modules\quanly\models;
use app\modules\quanly\base\QuanlyBaseModel;
use app\modules\quanly\models\danhmuc\DmGioitinh;
use app\modules\quanly\models\danhmuc\DmDantoc;
use app\modules\quanly\models\danhmuc\DmLoaicabenh;
use app\modules\quanly\models\danhmuc\DmLoaichandoan;
use app\modules\quanly\models\danhmuc\DmLoaiodich;
use app\modules\quanly\models\Giaothong;
use app\modules\quanly\models\Truonghoc;
use app\modules\quanly\models\Phuongxa;
use app\modules\quanly\models\Khupho;
use app\modules\quanly\models\Tinhthanh;
use app\modules\quanly\models\BenhVien;
use app\modules\quanly\models\Lophoc;
use Yii;

/**
 * This is the model class for table "ca_benh".
 *
 * @property int $id
 * @property int|null $loaibenh_id Loại ca bệnh
 * @property string|null $mabenhnhan Mã bệnh nhân
 * @property string|null $hoten Họ tên
 * @property string|null $ngaysinh Ngày sinh
 * @property int|null $gioitinh_id Giới tính
 * @property string|null $madinhdanh Mã định danh
 * @property string|null $ten_nguoibaoho Tên người bảo hộ
 * @property bool|null $cothai Có thai
 * @property string|null $sodienthoai Số điện thoại
 * @property int|null $tuanthai Tuần thai
 * @property string|null $nghenghiep Nghề nghiệp
 * @property string|null $noilamviec
 * @property string|null $diachi_noilamviec
 * @property int|null $khupho_noilamviec_id
 * @property string|null $diachi_noiohientai
 * @property int|null $khupho_noiohientai_id
 * @property string|null $so_hsba
 * @property string|null $coso_dieutri
 * @property string|null $hinhthuc_dieutri
 * @property int|null $chandoanchinh_id
 * @property string|null $phandobenh
 * @property string|null $chandoan_bienchung
 * @property string|null $doanbenhkem
 * @property string|null $benhnen
 * @property string|null $ngaykhoiphat
 * @property string|null $ngaynhapvien
 * @property string|null $ngay_xuatvien_chuyenvien_tuvong
 * @property string|null $phanloai_chandoan
 * @property bool|null $laymau_xetnghiem
 * @property string|null $loaibenhpham
 * @property string|null $ngaylaymau
 * @property string|null $loaixetnghiem
 * @property string|null $ketqua_xetnghiem
 * @property string|null $tinhtrang_tiemchung
 * @property int|null $somuitiem
 * @property string|null $tiensu_dichte
 * @property string|null $nguoi_dieutra_dichte
 * @property string|null $sdt_nguoi_dieutra_dichte
 * @property string|null $donvi_dieutra
 * @property string|null $ngay_dieutra_dichte
 * @property string|null $email_donvidieutra
 * @property string|null $donvi_baocao
 * @property int|null $tinhthanh_donvibaocao_id
 * @property string|null $ngaybaocao
 * @property string|null $nguoibaocao
 * @property string|null $sdt_nguoibaocao
 * @property string|null $email_nguoibaocao
 * @property string|null $trangthai_baocao
 * @property string|null $danhsach_coso_dieutri
 * @property string|null $ngay_chinhsua_gannhat
 * @property string|null $ngaycapnhat
 * @property string|null $phanloai_cabenh
 * @property string|null $ngaygop_trung_cabenh
 * @property string|null $so_nha
 * @property string|null $ten_duong
 * @property int|null $tenduong_id
 * @property int|null $truonghoc_id
 * @property int|null $truonghoc_khupho_id
 * @property string|null $ngaymacbenh
 * @property int|null $cabenhtrung_id
 * @property int|null $thangbaocao
 * @property string|null $loai_ca_benh
 * @property int|null $stt
 * @property int|null $dantoc_id
 * @property int|null $tinhthanh_noilamviec_id
 * @property int|null $tinhthanh_noiohientai_id
 * @property int|null $tinhthanh_cosodieutri_id
 * @property string|null $thongtin_dieutri
 * @property string|null $ghichu
 * @property string|null $tinhtrang_hiennay
 * @property string|null $ngaynhanve
 * @property int|null $namnhapvien
 * @property string|null $xacminh_cabenh
 * @property string|null $diachi_xacminh_cabenh
 * @property int|null $tinhthanh_xacminh_cabenh_id
 * @property int|null $phuongxa_xacminh_cabenh_id
 * @property int|null $khupho_xacminh_cabenh_id
 * @property string|null $noikhac_xacminh_cabenh
 * @property bool|null $tinhtrang_xuatvien
 * @property int|null $loaicabenh_id
 * @property string|null $ngaykhoibenh Ngày khởi bệnh
 * @property int|null $lophoc_id
 * @property string|null $ngaythongbao_cabenh
 * @property bool|null $cutru_tainha
 * @property bool|null $nha_cabenh
 * @property int|null $songuoi_tronggiadinh_sxh
 * @property int|null $songuoi_duoi15_sxh
 * @property bool|null $nhaco_benhnhan_sxh
 * @property bool|null $nhaco_nguoibenh
 * @property bool|null $benhvien_phongkham
 * @property bool|null $nhatho
 * @property bool|null $dinhchua
 * @property bool|null $congvien
 * @property bool|null $noihoihop
 * @property bool|null $noixaydung
 * @property bool|null $quancaphe
 * @property bool|null $noichannuoi
 * @property bool|null $noibancaycanh
 * @property bool|null $vuaphelieu
 * @property bool|null $noikhac
 * @property bool|null $cabenhchidiem
 * @property bool|null $dietlangquang
 * @property bool|null $giamsat_theodoi
 * @property bool|null $xuly_odich_nho
 * @property bool|null $cabenhthuphat
 * @property bool|null $odichmoi
 * @property string|null $noichandoan
 * @property string|null $phuongxa_noiohientai
 * @property string|null $phuongxa_noilamviec
 * @property string|null $phuongxa_sausapnhap
 * @property string|null $phuongxa
 * @property string|null $truonghoc_phuongxa
 * @property float|null $bi_bandau
 * @property float|null $ci_bandau
 * @property int|null $songuoi_giadinh_macbenh
 * @property int|null $songuoi_giadinh_macbenh_duoi15
 * @property string|null $ketluan_tinhtrang
 * @property string|null $ketluan_chandoan
 * @property string|null $ketluan_ngayxuatvien
 * @property string|null $ketluan_benhkhac
 * @property bool|null $px_daden
 * @property bool|null $pxkhac_daden
 * @property string|null $phuongxa_truonghoc
 * @property string|null $phuongxa_xacminhcabenh
 * @property string|null $donvi_thuchien_xetnghiem
 * @property int|null $status
 * @property string|null $created_at
 * @property string|null $updated_at
 * @property int|null $created_by
 * @property int|null $updated_by
 * @property int|null $benhvien_id
 * @property int|null $chandoan_bandau_id
 * @property string|null $xacminh_chandoan
 * @property bool|null $tinhtrangxuatvien
 * @property string|null $xacminh_xuly
 * @property bool|null $tamtru
 * @property int|null $cachidiem_id
 * @property int|null $namnhanve
 * @property int|null $songuoi_cutrru_giadinh
 * @property int|null $songuoi_cutru_giadinh_duoi15
 * @property bool|null $benhnoikhac
 * @property string|null $sonha_benhnoikhac
 * @property int|null $tenduong_benhnoikhac_id
 * @property string|null $phuongxa_benhnoikhac
 * @property int|null $khupho_benhnoikhac_id
 * @property string|null $noikhac_chitiet
 * @property string|null $trong_haituan_bisxh
 * @property bool|null $thanhpho_baove
 * @property bool|null $phathien_congdong
 * @property bool|null $conhapvien
 * @property bool|null $xuly_odich_dienrong
 * @property bool|null $cadautien
 * @property bool|null $codiachi
 * @property string|null $trong1thang_tiepxuc_tcm_truonghoc
 * @property bool|null $tiepxuc_tcm
 * @property bool|null $dinhatre_tcm
 * @property bool|null $tiepxuc_nguoichamsoc_tcm
 * @property bool|null $denkhudongnguoi_tcm
 * @property string|null $chitiet_denkhudongnguoi
 * @property bool|null $tiepxuc_tacnhan_gaynhiem_tcm
 * @property string|null $chitiet_tacnhan_tiepxuc_tcm
 * @property string|null $nguonnuoc_sudung_tcm
 * @property bool|null $anchung_tre_nghingo_tcm
 * @property string|null $chitiet_anchung_tre_nghingo_tcm
 * @property bool|null $dungdochoi_chung_tre_nghingo_tcm
 * @property string|null $chitiet_dungdochoichung_tre_nghingo_tcm
 * @property bool|null $dungchung_vatdung_tre_nghingo_tcm
 * @property string|null $chitiet_dungchung_vatdung_tre_nghingo_tcm
 * @property string|null $trong1thang_tiepxuc_giadinh_tcm
 * @property int|null $songuoi_bi_tcm_giadinh
 * @property int|null $songuoi_bi_tcm_giadinh_duoi15
 * @property int|null $sotogiapranh_khaosat_tcm
 * @property int|null $sotokhaosat_tcm
 * @property int|null $loaiodich__id
 * @property bool|null $khaosat_tcm_cocabenh_sxh
 * @property int|null $soca_khaosat_tcm_benhsxh
 *
 * @property BenhVien $benhvien
 * @property DmDantoc $dantoc
 * @property DmGioitinh $gioitinh
 * @property DmLoaicabenh $loaicabenh
 * @property DmLoaichandoan $loaibenh
 * @property DmLoaichandoan $chandoanchinh
 * @property DmLoaichandoan $chandoanBandau
 * @property DmLoaiodich $loaiodich
 * @property Giaothong $tenduong
 * @property Giaothong $tenduongBenhnoikhac
 * @property Khupho $khuphoNoilamviec
 * @property Khupho $khuphoNoiohientai
 * @property Khupho $truonghocKhupho
 * @property Khupho $khuphoBenhnoikhac
 * @property Lophoc $lophoc
 * @property Truonghoc $truonghoc
 */
class CaBenh extends QuanlyBaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ca_benh';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['loaibenh_id', 'gioitinh_id', 'tuanthai', 'khupho_noilamviec_id', 'khupho_noiohientai_id', 'chandoanchinh_id', 'somuitiem', 'tinhthanh_donvibaocao_id', 'tenduong_id', 'truonghoc_id', 'truonghoc_khupho_id', 'cabenhtrung_id', 'thangbaocao', 'stt', 'dantoc_id', 'tinhthanh_noilamviec_id', 'tinhthanh_noiohientai_id', 'tinhthanh_cosodieutri_id', 'namnhapvien', 'tinhthanh_xacminh_cabenh_id', 'phuongxa_xacminh_cabenh_id', 'khupho_xacminh_cabenh_id', 'loaicabenh_id', 'lophoc_id', 'songuoi_tronggiadinh_sxh', 'songuoi_duoi15_sxh', 'songuoi_giadinh_macbenh', 'songuoi_giadinh_macbenh_duoi15', 'status', 'created_by', 'updated_by', 'benhvien_id', 'chandoan_bandau_id', 'cachidiem_id', 'namnhanve', 'songuoi_cutrru_giadinh', 'songuoi_cutru_giadinh_duoi15', 'tenduong_benhnoikhac_id', 'khupho_benhnoikhac_id', 'songuoi_bi_tcm_giadinh', 'songuoi_bi_tcm_giadinh_duoi15', 'sotogiapranh_khaosat_tcm', 'sotokhaosat_tcm', 'loaiodich__id', 'soca_khaosat_tcm_benhsxh', 'dieutra_tcm_truonghoc_id'], 'default', 'value' => null],
            [['loaibenh_id', 'gioitinh_id', 'tuanthai', 'khupho_noilamviec_id', 'khupho_noiohientai_id', 'chandoanchinh_id', 'somuitiem', 'tinhthanh_donvibaocao_id', 'tenduong_id', 'truonghoc_id', 'truonghoc_khupho_id', 'cabenhtrung_id', 'thangbaocao', 'stt', 'dantoc_id', 'tinhthanh_noilamviec_id', 'tinhthanh_noiohientai_id', 'tinhthanh_cosodieutri_id', 'namnhapvien', 'tinhthanh_xacminh_cabenh_id', 'phuongxa_xacminh_cabenh_id', 'khupho_xacminh_cabenh_id', 'loaicabenh_id', 'lophoc_id', 'songuoi_tronggiadinh_sxh', 'songuoi_duoi15_sxh', 'songuoi_giadinh_macbenh', 'songuoi_giadinh_macbenh_duoi15', 'status', 'created_by', 'updated_by', 'benhvien_id', 'chandoan_bandau_id', 'cachidiem_id', 'namnhanve', 'songuoi_cutrru_giadinh', 'songuoi_cutru_giadinh_duoi15', 'tenduong_benhnoikhac_id', 'khupho_benhnoikhac_id', 'songuoi_bi_tcm_giadinh', 'songuoi_bi_tcm_giadinh_duoi15', 'sotogiapranh_khaosat_tcm', 'sotokhaosat_tcm', 'loaiodich__id', 'soca_khaosat_tcm_benhsxh', 'dieutra_tcm_truonghoc_id'], 'integer'],
            [['mabenhnhan', 'hoten', 'madinhdanh', 'ten_nguoibaoho', 'sodienthoai', 'nghenghiep', 'noilamviec', 'diachi_noilamviec', 'diachi_noiohientai', 'so_hsba', 'coso_dieutri', 'hinhthuc_dieutri', 'phandobenh', 'chandoan_bienchung', 'doanbenhkem', 'benhnen', 'phanloai_chandoan', 'loaibenhpham', 'ngaylaymau', 'loaixetnghiem', 'ketqua_xetnghiem', 'tinhtrang_tiemchung', 'tiensu_dichte', 'nguoi_dieutra_dichte', 'sdt_nguoi_dieutra_dichte', 'donvi_dieutra', 'email_donvidieutra', 'donvi_baocao', 'sdt_nguoibaocao', 'email_nguoibaocao', 'trangthai_baocao', 'danhsach_coso_dieutri', 'phanloai_cabenh', 'so_nha', 'ten_duong', 'loai_ca_benh', 'thongtin_dieutri', 'ghichu', 'tinhtrang_hiennay', 'xacminh_cabenh', 'diachi_xacminh_cabenh', 'noikhac_xacminh_cabenh', 'noichandoan', 'phuongxa_noiohientai', 'phuongxa_noilamviec', 'phuongxa_sausapnhap', 'phuongxa', 'truonghoc_phuongxa', 'ketluan_tinhtrang', 'ketluan_chandoan', 'ketluan_benhkhac', 'phuongxa_truonghoc', 'phuongxa_xacminhcabenh', 'donvi_thuchien_xetnghiem', 'xacminh_chandoan', 'xacminh_xuly', 'sonha_benhnoikhac', 'phuongxa_benhnoikhac', 'noikhac_chitiet', 'trong_haituan_bisxh', 'trong1thang_tiepxuc_tcm_truonghoc', 'chitiet_denkhudongnguoi', 'chitiet_tacnhan_tiepxuc_tcm', 'nguonnuoc_sudung_tcm', 'chitiet_anchung_tre_nghingo_tcm', 'chitiet_dungdochoichung_tre_nghingo_tcm', 'chitiet_dungchung_vatdung_tre_nghingo_tcm', 'trong1thang_tiepxuc_giadinh_tcm'], 'string'],
            [['ngaysinh', 'ngaykhoiphat', 'ngaynhapvien', 'ngay_xuatvien_chuyenvien_tuvong', 'ngay_dieutra_dichte', 'ngaybaocao', 'ngay_chinhsua_gannhat', 'ngaycapnhat', 'ngaygop_trung_cabenh', 'ngaymacbenh', 'ngaynhanve', 'ngaykhoibenh', 'ngaythongbao_cabenh', 'ketluan_ngayxuatvien', 'created_at', 'updated_at'], 'safe'],
            [['cothai', 'laymau_xetnghiem', 'tinhtrang_xuatvien', 'cutru_tainha', 'nha_cabenh', 'nhaco_benhnhan_sxh', 'nhaco_nguoibenh', 'benhvien_phongkham', 'nhatho', 'dinhchua', 'congvien', 'noihoihop', 'noixaydung', 'quancaphe', 'noichannuoi', 'noibancaycanh', 'vuaphelieu', 'noikhac', 'cabenhchidiem', 'dietlangquang', 'giamsat_theodoi', 'xuly_odich_nho', 'cabenhthuphat', 'odichmoi', 'px_daden', 'pxkhac_daden', 'tinhtrangxuatvien', 'tamtru', 'benhnoikhac', 'thanhpho_baove', 'phathien_congdong', 'conhapvien', 'xuly_odich_dienrong', 'cadautien', 'codiachi', 'tiepxuc_tcm', 'dinhatre_tcm', 'tiepxuc_nguoichamsoc_tcm', 'denkhudongnguoi_tcm', 'tiepxuc_tacnhan_gaynhiem_tcm', 'anchung_tre_nghingo_tcm', 'dungdochoi_chung_tre_nghingo_tcm', 'dungchung_vatdung_tre_nghingo_tcm', 'khaosat_tcm_cocabenh_sxh', 'dieutra_tcm_codihoc'], 'boolean'],
            [['bi_bandau', 'ci_bandau'], 'number'],
            [['nguoibaocao'], 'string', 'max' => 225],
            [['benhvien_id'], 'exist', 'skipOnError' => true, 'targetClass' => BenhVien::className(), 'targetAttribute' => ['benhvien_id' => 'id']],
            [['dantoc_id'], 'exist', 'skipOnError' => true, 'targetClass' => DmDantoc::className(), 'targetAttribute' => ['dantoc_id' => 'id']],
            [['gioitinh_id'], 'exist', 'skipOnError' => true, 'targetClass' => DmGioitinh::className(), 'targetAttribute' => ['gioitinh_id' => 'id']],
            [['loaicabenh_id'], 'exist', 'skipOnError' => true, 'targetClass' => DmLoaicabenh::className(), 'targetAttribute' => ['loaicabenh_id' => 'id']],
            [['loaibenh_id'], 'exist', 'skipOnError' => true, 'targetClass' => DmLoaichandoan::className(), 'targetAttribute' => ['loaibenh_id' => 'id']],
            [['chandoanchinh_id'], 'exist', 'skipOnError' => true, 'targetClass' => DmLoaichandoan::className(), 'targetAttribute' => ['chandoanchinh_id' => 'id']],
            [['chandoan_bandau_id'], 'exist', 'skipOnError' => true, 'targetClass' => DmLoaichandoan::className(), 'targetAttribute' => ['chandoan_bandau_id' => 'id']],
            [['loaiodich__id'], 'exist', 'skipOnError' => true, 'targetClass' => DmLoaiodich::className(), 'targetAttribute' => ['loaiodich__id' => 'id']],
            [['tenduong_id'], 'exist', 'skipOnError' => true, 'targetClass' => Giaothong::className(), 'targetAttribute' => ['tenduong_id' => 'id']],
            [['tenduong_benhnoikhac_id'], 'exist', 'skipOnError' => true, 'targetClass' => Giaothong::className(), 'targetAttribute' => ['tenduong_benhnoikhac_id' => 'id']],
            [['khupho_noilamviec_id'], 'exist', 'skipOnError' => true, 'targetClass' => Khupho::className(), 'targetAttribute' => ['khupho_noilamviec_id' => 'id']],
            [['khupho_noiohientai_id'], 'exist', 'skipOnError' => true, 'targetClass' => Khupho::className(), 'targetAttribute' => ['khupho_noiohientai_id' => 'id']],
            [['truonghoc_khupho_id'], 'exist', 'skipOnError' => true, 'targetClass' => Khupho::className(), 'targetAttribute' => ['truonghoc_khupho_id' => 'id']],
            [['khupho_benhnoikhac_id'], 'exist', 'skipOnError' => true, 'targetClass' => Khupho::className(), 'targetAttribute' => ['khupho_benhnoikhac_id' => 'id']],
            [['lophoc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Lophoc::className(), 'targetAttribute' => ['lophoc_id' => 'id']],
            [['truonghoc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Truonghoc::className(), 'targetAttribute' => ['truonghoc_id' => 'gid']],
            [['dieutra_tcm_truonghoc_id'], 'exist', 'skipOnError' => true, 'targetClass' => Truonghoc::className(), 'targetAttribute' => ['dieutra_tcm_truonghoc_id' => 'gid']],
            [['loaibenh_id'], 'required']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'loaibenh_id' => 'Loại bệnh',
            'mabenhnhan' => 'Mã bệnh nhân',
            'hoten' => 'Họ và tên',
            'ngaysinh' => 'Ngày sinh',
            'gioitinh_id' => 'Giới tính',
            'madinhdanh' => 'Mã định danh',
            'ten_nguoibaoho' => 'Tên người bảo hộ',
            'cothai' => 'Có thai',
            'sodienthoai' => 'Số điện thoại',
            'tuanthai' => 'Tuần thai',
            'nghenghiep' => 'Nghề nghiệp',
            'noilamviec' => 'Nơi làm việc',
            'diachi_noilamviec' => 'Địa chỉ nơi làm việc',
            'khupho_noilamviec_id' => 'Khu phố nơi làm việc',
            'diachi_noiohientai' => 'Địa chỉ nơi ở hiện tại',
            'khupho_noiohientai_id' => 'Khu phố nơi ở hiện tại',
            'so_hsba' => 'Số hồ sơ bệnh án',
            'coso_dieutri' => 'Cơ sở điều trị',
            'hinhthuc_dieutri' => 'Hình thức điều trị',
            'chandoanchinh_id' => 'Chẩn đoán chính',
            'phandobenh' => 'Phân độ bệnh',
            'chandoan_bienchung' => 'Chẩn đoán biến chứng',
            'doanbenhkem' => 'Bệnh kèm theo',
            'benhnen' => 'Bệnh nền',
            'ngaykhoiphat' => 'Ngày khởi phát',
            'ngaynhapvien' => 'Ngày nhập viện',
            'ngay_xuatvien_chuyenvien_tuvong' => 'Ngày ra viện / chuyển viện / tử vong',
            'phanloai_chandoan' => 'Phân loại chẩn đoán',
            'laymau_xetnghiem' => 'Lấy mẫu xét nghiệm',
            'loaibenhpham' => 'Loại bệnh phẩm',
            'ngaylaymau' => 'Ngày lấy mẫu',
            'loaixetnghiem' => 'Loại xét nghiệm',
            'ketqua_xetnghiem' => 'Kết quả xét nghiệm',
            'tinhtrang_tiemchung' => 'Tình trạng tiêm chủng',
            'somuitiem' => 'Số mũi tiêm',
            'tiensu_dichte' => 'Tiền sử dịch tễ',
            'nguoi_dieutra_dichte' => 'Người điều tra dịch tễ',
            'sdt_nguoi_dieutra_dichte' => 'SĐT người điều tra',
            'donvi_dieutra' => 'Đơn vị điều tra',
            'ngay_dieutra_dichte' => 'Ngày điều tra',
            'email_donvidieutra' => 'Email đơn vị điều tra',
            'donvi_baocao' => 'Đơn vị báo cáo',
            'tinhthanh_donvibaocao_id' => 'Tỉnh/Thành đơn vị báo cáo',
            'ngaybaocao' => 'Ngày báo cáo',
            'nguoibaocao' => 'Người báo cáo',
            'sdt_nguoibaocao' => 'SĐT người báo cáo',
            'email_nguoibaocao' => 'Email người báo cáo',
            'trangthai_baocao' => 'Trạng thái báo cáo',
            'danhsach_coso_dieutri' => 'Danh sách cơ sở điều trị',
            'ngay_chinhsua_gannhat' => 'Ngày chỉnh sửa gần nhất',
            'ngaycapnhat' => 'Ngày cập nhật',
            'phanloai_cabenh' => 'Phân loại ca bệnh',
            'ngaygop_trung_cabenh' => 'Ngày gộp trùng ca bệnh',
            'so_nha' => 'Số nhà',
            'ten_duong' => 'Tên đường',
            'tenduong_id' => 'Đường',
            'truonghoc_id' => 'Trường học',
            'truonghoc_khupho_id' => 'Khu phố trường học',
            'ngaymacbenh' => 'Ngày mắc bệnh',
            'cabenhtrung_id' => 'Ca bệnh trùng',
            'thangbaocao' => 'Tháng báo cáo',
            'loai_ca_benh' => 'Loại ca bệnh',
            'stt' => 'STT',
            'dantoc_id' => 'Dân tộc',
            'tinhthanh_noilamviec_id' => 'Tỉnh/Thành nơi làm việc',
            'tinhthanh_noiohientai_id' => 'Tỉnh/Thành nơi ở hiện tại',
            'tinhthanh_cosodieutri_id' => 'Tỉnh/Thành cơ sở điều trị',
            'thongtin_dieutri' => 'Thông tin điều trị',
            'ghichu' => 'Ghi chú',
            'tinhtrang_hiennay' => 'Tình trạng hiện nay',
            'ngaynhanve' => 'Ngày nhận về',
            'namnhapvien' => 'Năm nhập viện',
            'xacminh_cabenh' => 'Xác minh ca bệnh',
            'diachi_xacminh_cabenh' => 'Địa chỉ xác minh ca bệnh',
            'tinhthanh_xacminh_cabenh_id' => 'Tỉnh/Thành xác minh ca bệnh',
            'phuongxa_xacminh_cabenh_id' => 'Phường/Xã xác minh ca bệnh',
            'khupho_xacminh_cabenh_id' => 'Khu phố xác minh ca bệnh',
            'noikhac_xacminh_cabenh' => 'Nơi khác (xác minh ca bệnh)',
            'tinhtrang_xuatvien' => 'Tình trạng xuất viện',
            'loaicabenh_id' => 'Loại ca bệnh',
            'ngaykhoibenh' => 'Ngày khỏi bệnh',
            'lophoc_id' => 'Lớp học',
            'ngaythongbao_cabenh' => 'Ngày thông báo ca bệnh',
            'cutru_tainha' => 'Cư trú tại nhà',
            'nha_cabenh' => 'Nhà ca bệnh',
            'songuoi_tronggiadinh_sxh' => 'Số người trong gia đình (SXH)',
            'songuoi_duoi15_sxh' => 'Số người dưới 15 tuổi (SXH)',
            'nhaco_benhnhan_sxh' => 'Nhà có bệnh nhân (SXH)',
            'nhaco_nguoibenh' => 'Nhà có người bệnh',
            'benhvien_phongkham' => 'Bệnh viện / Phòng khám',
            'nhatho' => 'Nhà thờ',
            'dinhchua' => 'Đình/Chùa',
            'congvien' => 'Công viên',
            'noihoihop' => 'Nơi hội họp',
            'noixaydung' => 'Nơi xây dựng',
            'quancaphe' => 'Quán cà phê',
            'noichannuoi' => 'Nơi chăn nuôi',
            'noibancaycanh' => 'Nơi bán cây cảnh',
            'vuaphelieu' => 'Vựa phế liệu',
            'noikhac' => 'Nơi khác',
            'cabenhchidiem' => 'Ca bệnh chỉ điểm',
            'dietlangquang' => 'Diệt lăng quăng',
            'giamsat_theodoi' => 'Giám sát theo dõi',
            'xuly_odich_nho' => 'Xử lý ổ dịch nhỏ',
            'cabenhthuphat' => 'Ca bệnh thứ phát',
            'odichmoi' => 'Ổ dịch mới',
            'noichandoan' => 'Nơi chẩn đoán',
            'phuongxa_noiohientai' => 'Phường/Xã nơi ở hiện tại',
            'phuongxa_noilamviec' => 'Phường/Xã nơi làm việc',
            'phuongxa_sausapnhap' => 'Phường/Xã sau sáp nhập',
            'phuongxa' => 'Phường/Xã',
            'truonghoc_phuongxa' => 'Phường/Xã trường học',
            'bi_bandau' => 'B.I ban đầu',
            'ci_bandau' => 'C.I ban đầu',
            'songuoi_giadinh_macbenh' => 'Số người gia đình mắc bệnh',
            'songuoi_giadinh_macbenh_duoi15' => 'Số người dưới 15 tuổi mắc bệnh',
            'ketluan_tinhtrang' => 'Kết luận tình trạng',
            'ketluan_chandoan' => 'Kết luận chẩn đoán',
            'ketluan_ngayxuatvien' => 'Kết luận ngày xuất viện',
            'ketluan_benhkhac' => 'Kết luận bệnh khác',
            'px_daden' => 'Phường/Xã đã đến',
            'pxkhac_daden' => 'Phường/Xã khác đã đến',
            'phuongxa_truonghoc' => 'Phường/Xã trường học',
            'phuongxa_xacminhcabenh' => 'Phường/Xã xác minh ca bệnh',
            'donvi_thuchien_xetnghiem' => 'Đơn vị thực hiện xét nghiệm',
            'status' => 'Trạng thái',
            'created_at' => 'Ngày tạo',
            'updated_at' => 'Ngày cập nhật',
            'created_by' => 'Người tạo',
            'updated_by' => 'Người cập nhật',
            'benhvien_id' => 'Bệnh viện',
            'chandoan_bandau_id' => 'Chẩn đoán ban đầu',
            'xacminh_chandoan' => 'Xác minh chẩn đoán',
            'tinhtrangxuatvien' => 'Tình trạng xuất viện',
            'xacminh_xuly' => 'Xác minh xử lý',
            'tamtru' => 'Tạm trú',
            'cachidiem_id' => 'Ca chỉ điểm',
            'namnhanve' => 'Năm nhận về',
            'songuoi_cutrru_giadinh' => 'Số người cư trú trong gia đình',
            'songuoi_cutru_giadinh_duoi15' => 'Số người cư trú trong gia đình dưới 15 tuổi',
            'benhnoikhac' => 'Bệnh nơi khác',
            'sonha_benhnoikhac' => 'Số nhà',
            'tenduong_benhnoikhac_id' => 'Tên đường',
            'phuongxa_benhnoikhac' => 'Phường xã',
            'khupho_benhnoikhac_id' => 'Khu phố',
            'noikhac_chitiet' => 'Nơi khác chi tiết',
            'trong_haituan_bisxh' => 'Trong hai tuần bị SXH',
            'thanhpho_baove' => 'Thành phố báo về',
            'phathien_congdong' => 'Phát hiện cộng đồng',
            'conhapvien' => 'Có nhập viện',
            'xuly_odich_dienrong' => 'Xử lý ổ dịch diện rộng',
            'cadautien' => 'Ca đầu tiên',
            'codiachi' => 'Có địa chỉ',
            'trong1thang_tiepxuc_tcm_truonghoc' => 'Trong 1 tháng tiếp xúc TCM tại trường học',
            'tiepxuc_tcm' => 'Tiếp xúc TCM',
            'dinhatre_tcm' => 'Đi nhà trẻ TCM',
            'tiepxuc_nguoichamsoc_tcm' => 'Tiếp xúc người chăm sóc TCM',
            'denkhudongnguoi_tcm' => 'Đến khu đông người TCM',
            'chitiet_denkhudongnguoi' => 'Chi tiết đến khu đông người',
            'tiepxuc_tacnhan_gaynhiem_tcm' => 'Tiếp xúc tác nhân gây nhiễm TCM',
            'chitiet_tacnhan_tiepxuc_tcm' => 'Chi tiết tác nhân tiếp xúc TCM',
            'nguonnuoc_sudung_tcm' => 'Nguồn nước sử dụng',
            'anchung_tre_nghingo_tcm' => 'Ăn chung trẻ nghi ngờ TCM',
            'chitiet_anchung_tre_nghingo_tcm' => 'Chi tiết ăn chung trẻ nghi ngờ TCM',
            'dungdochoi_chung_tre_nghingo_tcm' => 'Dùng đồ chơi chung với trẻ nghi ngờ TCM',
            'chitiet_dungdochoichung_tre_nghingo_tcm' => 'Chi tiết dùng đồ chơi chung với trẻ nghi ngờ TCM',
            'dungchung_vatdung_tre_nghingo_tcm' => 'Dùng chung vật dụng với trẻ nghi ngờ TCM',
            'chitiet_dungchung_vatdung_tre_nghingo_tcm' => 'Chi tiết dùng chung vật dụng với trẻ nghi ngờ TCM',
            'trong1thang_tiepxuc_giadinh_tcm' => 'Trong 1 tháng tiếp xúc TCM trong gia đình',
            'songuoi_bi_tcm_giadinh' => 'Số người bị TCM trong gia đình',
            'songuoi_bi_tcm_giadinh_duoi15' => 'Số người bị TCM trong gia đình (dưới 15 tuổi)',
            'sotogiapranh_khaosat_tcm' => 'Số tổ giáp ranh khảo sát TCM',
            'sotokhaosat_tcm' => 'Số tổ khảo sát TCM',
            'loaiodich__id' => 'Loại ổ dịch',
            'khaosat_tcm_cocabenh_sxh' => 'Khảo sát TCM có ca bệnh SXH',
            'soca_khaosat_tcm_benhsxh' => 'Số ca khảo sát TCM bệnh SXH',
            'dieutra_tcm_codihoc' => 'Điều tra bệnh TCM có đi học',
            'dieutra_tcm_truonghoc_id' => 'Trường học'
        ];
    }

    public function getPhuongxachinh()
    {
        return $this->hasOne(Phuongxa::className(), ['ma_dvhc' => 'phuongxa']);
    }

    public function getPhuongxaNoiohientai()
    {
        return $this->hasOne(Phuongxa::className(), ['ma_dvhc' => 'phuongxa_noiohientai']);
    }

    public function getPhuongxaNoilamviec()
    {
        return $this->hasOne(Phuongxa::className(), ['ma_dvhc' => 'phuongxa_noilamviec']);
    }

    public function getPhuongxaBenhnoikhac()
    {
        return $this->hasOne(Phuongxa::className(), ['ma_dvhc' => 'phuongxa_benhnoikhac']);
    }

    public function getTruonghocPhuongxa()
    {
        return $this->hasOne(Phuongxa::className(), ['ma_dvhc' => 'truonghoc_phuongxa']);
    }

    public function getPhuongxaXacminhCabenh()
    {
        return $this->hasOne(Phuongxa::className(), ['ma_dvhc' => 'phuongxa_xacminhcabenh']);
    }

    public function getKhuphoXacminhCabenh()
    {
        return $this->hasOne(Khupho::className(), ['id' => 'khupho_xacminh_cabenh_id']);
    }

    /**
     * Gets query for [[Benhvien]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBenhvien()
    {
        return $this->hasOne(BenhVien::className(), ['id' => 'benhvien_id']);
    }

    /**
     * Gets query for [[Dantoc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDantoc()
    {
        return $this->hasOne(DmDantoc::className(), ['id' => 'dantoc_id']);
    }

    /**
     * Gets query for [[Gioitinh]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGioitinh()
    {
        return $this->hasOne(DmGioitinh::className(), ['id' => 'gioitinh_id']);
    }

    /**
     * Gets query for [[Loaicabenh]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoaicabenh()
    {
        return $this->hasOne(DmLoaicabenh::className(), ['id' => 'loaicabenh_id']);
    }

    /**
     * Gets query for [[Loaibenh]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoaibenh()
    {
        return $this->hasOne(DmLoaichandoan::className(), ['id' => 'loaibenh_id']);
    }

    /**
     * Gets query for [[Chandoanchinh]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChandoanchinh()
    {
        return $this->hasOne(DmLoaichandoan::className(), ['id' => 'chandoanchinh_id']);
    }

    /**
     * Gets query for [[ChandoanBandau]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getChandoanBandau()
    {
        return $this->hasOne(DmLoaichandoan::className(), ['id' => 'chandoan_bandau_id']);
    }

    /**
     * Gets query for [[Loaiodich]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLoaiodich()
    {
        return $this->hasOne(DmLoaiodich::className(), ['id' => 'loaiodich__id']);
    }

    /**
     * Gets query for [[Tenduong]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTenduong()
    {
        return $this->hasOne(Giaothong::className(), ['id' => 'tenduong_id']);
    }

    /**
     * Gets query for [[TenduongBenhnoikhac]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTenduongBenhnoikhac()
    {
        return $this->hasOne(Giaothong::className(), ['id' => 'tenduong_benhnoikhac_id']);
    }

    /**
     * Gets query for [[KhuphoNoilamviec]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKhuphoNoilamviec()
    {
        return $this->hasOne(Khupho::className(), ['id' => 'khupho_noilamviec_id']);
    }

    /**
     * Gets query for [[KhuphoNoiohientai]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKhuphoNoiohientai()
    {
        return $this->hasOne(Khupho::className(), ['id' => 'khupho_noiohientai_id']);
    }

    /**
     * Gets query for [[TruonghocKhupho]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTruonghocKhupho()
    {
        return $this->hasOne(Khupho::className(), ['id' => 'truonghoc_khupho_id']);
    }

    /**
     * Gets query for [[KhuphoBenhnoikhac]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKhuphoBenhnoikhac()
    {
        return $this->hasOne(Khupho::className(), ['id' => 'khupho_benhnoikhac_id']);
    }

    /**
     * Gets query for [[Lophoc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLophoc()
    {
        return $this->hasOne(Lophoc::className(), ['id' => 'lophoc_id']);
    }

    /**
     * Gets query for [[Truonghoc]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTruonghoc()
    {
        return $this->hasOne(Truonghoc::className(), ['gid' => 'truonghoc_id']);
    }

    public function getDieutraTcmTruonghoc()
    {
        return $this->hasOne(Truonghoc::className(), ['gid' => 'dieutra_tcm_truonghoc_id']);
    }
}
 