<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\CaBenh $model */

$this->title = 'Chi tiết ca bệnh #' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Danh sách ca bệnh', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="ca-benh-view container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3><i class="bi bi-person-lines-fill"></i> <?= Html::encode($this->title) ?></h3>
        <div>
           
            <?= Html::a('<i class="bi bi-arrow-left"></i> Quay lại', ['index'], ['class' => 'btn btn-secondary']) ?>
        </div>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            //'loaibenh_id',
            [
                'label' => 'Loại bệnh',
                'value' => function($model){
                    return ($model->loaibenh_id != null) ?  $model->loaibenh->ten : '';
                }
            ],
            'mabenhnhan',
            'hoten',
            'ngaysinh',
            //'gioitinh_id',
            [
                'label' => 'Giới tính',
                'value' => function($model){
                    return ($model->gioitinh_id != null) ?  $model->gioitinh->ten : '';
                }
            ],
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
            //'chandoanchinh_id',
            [
                'label' => 'Chẩn đoán chính',
                'value' => function($model){
                    return ($model->chandoanchinh_id != null) ?  $model->chandoanchinh->ten : '';
                }
            ],
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
            //'tinhthanh_donvibaocao_id',
            [
                'label' => 'Tỉnh thành đơn vị báo cáo',
                'value' => function($model){
                    return ($model->tinhthanh_donvibaocao_id != null) ?  'HCM' : '';
                }
            ],
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
            //'ten_duong',
            'tenduong_id',
            'truonghoc_id',
            'truonghoc_khupho_id',
            'ngaymacbenh',
            'cabenhtrung_id',
            'thangbaocao',
            'loai_ca_benh',
            'stt',
            //'dantoc_id',
            [
                'label' => 'Dân tộc',
                'value' => function($model){
                    return ($model->dantoc_id != null) ?  $model->dantoc->ten : '';
                }
            ],
            'tinhthanh_noilamviec_id',
            'tinhthanh_noiohientai_id',
            'tinhthanh_cosodieutri_id',
            'thongtin_dieutri:ntext',
            'ghichu:ntext',
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
            //'loaicabenh_id',
            [
                'label' => 'Loại ca bệnh',
                'value' => function($model){
                    return ($model->loaicabenh_id != null) ?  $model->loaicabenh->ten : '';
                }
            ],
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
            [
                'label' => 'Phường xã',
                'value' => function($model){
                    return ($model->phuongxa != null) ?  $model->phuongxachinh->ten_dvhc : '';
                }
            ],
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
            // 'status',
            // 'created_attime',
            // 'updated_attime',
            // 'created_by',
            // 'updated_by',
            'benhvien_id',
            'chandoan_bandau_id',
            'xacminh_chandoan',
            'tinhtrangxuatvien',
            'xacminh_xuly',
            'tamtru',
            'cachidiem_id',
            'namnhanve',
        ],
        'options' => ['class' => 'table table-bordered table-striped detail-view'],
    ]) ?>

</div>