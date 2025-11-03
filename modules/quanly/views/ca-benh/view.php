<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\CaBenh */

// Lấy thông tin từ Controller (giả định)
$requestedAction = Yii::$app->requestedAction;
$controller = $requestedAction->controller;
$label = $controller->label;

$this->title = Yii::t('app', $label[$requestedAction->id] . ' ' . $controller->title);
$this->params['breadcrumbs'][] = ['label' => $label['index'], 'url' => Url::to(['index'])];
$this->params['breadcrumbs'][] = $this->title;

// --- Helper Functions (Chỉ còn hàm quan hệ) ---

// Hàm lấy giá trị từ quan hệ (relation name phải là tên hàm get...() bỏ đi 'get')
$relationFormat = function ($attribute, $relationName) use ($model) {
    $relation = $model->$relationName;
    
    if($attribute == 'truonghoc_id'){
        $value = $relation ? $relation->ten_dv : null;
    }
    elseif($attribute == 'lophoc_id'){
        $value = $relation ? $relation->tenlop : null;
    }
    elseif($attribute == 'benhvien_id'){
        $value = $relation ? $relation->tenbenhvien : null;
    }else{
        $value = $relation ? $relation->ten : null;
    }
    
    return [
        'attribute' => $attribute,
        'value' =>  $value, 
        'label' => $model->getAttributeLabel($attribute),
    ];
};

$relationPhuongFormat = function ($attribute, $relationName) use ($model) {
    $relation = $model->$relationName;
    return [
        'attribute' => $attribute,
        'value' => $relation ? $relation->ten_dvhc : null, 
        'label' => $model->getAttributeLabel($attribute),
    ];
};

$relationGiaothongFormat = function ($attribute, $relationName) use ($model) {
    $relation = $model->$relationName;
    return [
        'attribute' => $attribute,
        'value' => $relation ? $relation->name : null, 
        'label' => $model->getAttributeLabel($attribute),
    ];
};

?>

<div class="ca-benh-view py-3">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 text-primary mb-0"><?= Html::encode($this->title) ?>: <span class="fw-normal text-secondary"><?= Html::encode($model->hoten) ?></span></h1>
        
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0"><i class="fas fa-user-tag me-2"></i> Thông tin cơ bản</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            $relationFormat('loaibenh_id', 'loaibenh'),
                            'mabenhnhan',
                            'hoten',
                            [
                                'attribute' => 'ngaysinh',
                                
                            ],
                            $relationFormat('gioitinh_id', 'gioitinh'),
                            $relationFormat('dantoc_id', 'dantoc'),
                            'so_hsba',
                            'hinhthuc_dieutri',
                            'coso_dieutri'
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-4">{label}</th><td class="col-8">{value}</td></tr>',
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'madinhdanh',
                            'sodienthoai',
                            'ten_nguoibaoho',
                            'ngaybaocao',
                            'ngaythongbao_cabenh',
                            $relationFormat('loaicabenh_id', 'loaicabenh'),
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-4">{label}</th><td class="col-8">{value}</td></tr>',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="fas fa-school me-2"></i> Thông tin học tập</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-warning border-bottom pb-2 mb-3">Thông tin Học tập</h6>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            $relationFormat('truonghoc_id', 'truonghoc'),
                            $relationFormat('lophoc_id', 'lophoc'),
                            $relationPhuongFormat('truonghoc_phuongxa', 'truonghocPhuongxa'),
                            $relationPhuongFormat('truonghoc_khupho_id', 'truonghocKhupho'),
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-4">{label}</th><td class="col-8">{value}</td></tr>',
                    ]) ?>
                </div>
               
            </div>
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-info text-white">
            <h5 class="mb-0"><i class="fas fa-map-marker-alt me-2"></i> Thông tin xác minh ca bệnh</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-info border-bottom pb-2 mb-3">Nơi ở hiện tại</h6>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            // $relationFormat('tinhthanh_noiohientai_id', 'tinhthanhNoiohientai'),
                            // $relationFormat('quanhuyen_noiohientai_id', 'quanhuyenNoiohientai'),
                            'diachi_noiohientai',
                            'so_nha',
                            $relationGiaothongFormat('tenduong_id', 'tenduong'),
                            $relationPhuongFormat('phuongxa_noiohientai', 'phuongxaNoiohientai'),
                            $relationPhuongFormat('khupho_noiohientai_id', 'khuphoNoiohientai'),
                            
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-4">{label}</th><td class="col-8">{value}</td></tr>',
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <h6 class="text-info border-bottom pb-2 mb-3">Xác minh thông tin bệnh nơi khác</h6>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute' => 'benhnoikhac',
                                'value' => $model->benhnoikhac ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            'sonha_benhnoikhac',
                            $relationGiaothongFormat('tenduong_benhnoikhac_id', 'tenduongBenhnoikhac'),
                            // $relationFormat('tinhthanh_noilamviec_id', 'tinhthanhNoilamviec'),
                            // $relationFormat('quanhuyen_noilamviec_id', 'quanhuyenNoilamviec'),
                            $relationPhuongFormat('phuongxa_benhnoikhac', 'phuongxaBenhnoikhac'),
                            $relationPhuongFormat('khupho_benhnoikhac_id', 'khuphoBenhnoikhac'),
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-4">{label}</th><td class="col-8">{value}</td></tr>',
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <h6 class="text-info border-bottom pb-2 mb-3">Thông tin cư trú của gia đình</h6>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'songuoi_cutrru_giadinh',
                            'songuoi_cutru_giadinh_duoi15'
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-4">{label}</th><td class="col-8">{value}</td></tr>',
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <h6 class="text-info border-bottom pb-2 mb-3">Thông tin xác minh ca bệnh</h6>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'loai_ca_benh',
                            'xacminh_cabenh',
                            'diachi_xacminh_cabenh',
                            $relationPhuongFormat('phuongxa_xacminhcabenh', 'phuongxaXacminhCabenh'),
                            $relationPhuongFormat('khupho_xacminh_cabenh_id', 'khuphoXacminhCabenh'),
                            'ngaymacbenh',
                            [
                                'attribute' => 'tinhtrang_xuatvien',
                                'value' => $model->tinhtrang_xuatvien ? '<span class="badge bg-success">Có</span>' : '<span class="badge bg-danger">Chưa</span>',
                                'format' => 'raw',
                            ],
                            $relationFormat('chandoanchinh_id', 'chandoanchinh'),
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-4">{label}</th><td class="col-8">{value}</td></tr>',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-success text-white">
            <h5 class="mb-0"><i class="fas fa-notes-medical me-2"></i>Thông tin điều tra dịch tể</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-success border-bottom pb-2 mb-3">Thông tin điều tra</h6>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute' => 'thanhpho_baove',
                                'value' => $model->thanhpho_baove ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'phathien_congdong',
                                'value' => $model->phathien_congdong ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'conhapvien',
                                'value' => $model->conhapvien ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            $relationFormat('benhvien_id', 'benhvien'),
                            'ngay_dieutra_dichte',
                            'ngaynhapvien',
                            'nghenghiep'
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-4">{label}</th><td class="col-8">{value}</td></tr>',
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <h6 class="text-success border-bottom pb-2 mb-3">Thông tin xét nghiệm</h6>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute' => 'laymau_xetnghiem',
                                'value' => $model->laymau_xetnghiem ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            'loaibenhpham',
                            'donvi_thuchien_xetnghiem',
                            'loaixetnghiem',
                            'ngaylaymau',
                            'ketqua_xetnghiem',
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-4">{label}</th><td class="col-8">{value}</td></tr>',
                    ]) ?>
                </div>
            </div>
            <?php if($model->loaibenh_id != null && $model->loaibenh_id == 2): ?>
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="text-success border-bottom pb-2 mb-3">Thông tin khảo sát TCM</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'trong1thang_tiepxuc_tcm_truonghoc',
                            [
                                'attribute' => 'tiepxuc_tcm',
                                'value' => $model->tiepxuc_tcm ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'dinhatre_tcm',
                                'value' => $model->dinhatre_tcm ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'tiepxuc_nguoichamsoc_tcm',
                                'value' => $model->tiepxuc_nguoichamsoc_tcm ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'denkhudongnguoi_tcm',
                                'value' => $model->denkhudongnguoi_tcm ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            'chitiet_denkhudongnguoi',
                            [
                                'attribute' => 'tiepxuc_tacnhan_gaynhiem_tcm',
                                'value' => $model->tiepxuc_tacnhan_gaynhiem_tcm ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            'chitiet_tacnhan_tiepxuc_tcm',
                            [
                                'attribute' => 'anchung_tre_nghingo_tcm',
                                'value' => $model->anchung_tre_nghingo_tcm ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            'chitiet_anchung_tre_nghingo_tcm',                            
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-4">{label}</th><td class="col-8">{value}</td></tr>',
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'nguonnuoc_sudung_tcm',
                            [
                                'attribute' => 'dungdochoi_chung_tre_nghingo_tcm',
                                'value' => $model->dungdochoi_chung_tre_nghingo_tcm ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            'chitiet_dungdochoichung_tre_nghingo_tcm',
                            [
                                'attribute' => 'dungchung_vatdung_tre_nghingo_tcm',
                                'value' => $model->tiepxuc_tacnhan_gaynhiem_tcm ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            'chitiet_dungchung_vatdung_tre_nghingo_tcm',
                            [
                                'attribute' => 'trong1thang_tiepxuc_giadinh_tcm',
                                'value' => $model->trong1thang_tiepxuc_giadinh_tcm ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            'songuoi_bi_tcm_giadinh',     
                            'songuoi_bi_tcm_giadinh_duoi15' ,                      
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-4">{label}</th><td class="col-8">{value}</td></tr>',
                    ]) ?>
                </div>
            </div>
            <?php else: ?>
            <div class="row">
                <div class="col-lg-12">
                    <h6 class="text-success border-bottom pb-2 mb-3">Thông khảo sát SXH</h6>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'trong_haituan_bisxh',
                            [
                                'attribute' => 'laymau_xetnghiem',
                                'value' => $model->laymau_xetnghiem ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'nhaco_benhnhan_sxh',
                                'value' => $model->nhaco_benhnhan_sxh ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'nhaco_nguoibenh',
                                'value' => $model->nhaco_nguoibenh ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'benhvien_phongkham',
                                'value' => $model->benhvien_phongkham ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'nhatho',
                                'value' => $model->nhatho ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'dinhchua',
                                'value' => $model->dinhchua ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'congvien',
                                'value' => $model->congvien ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-4">{label}</th><td class="col-8">{value}</td></tr>',
                    ]) ?>
                </div>
                <div class="col-md-6">
                    
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            [
                                'attribute' => 'noihoihop',
                                'value' => $model->noihoihop ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'noixaydung',
                                'value' => $model->noixaydung ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'quancaphe',
                                'value' => $model->quancaphe ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'noichannuoi',
                                'value' => $model->noichannuoi ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'noibancaycanh',
                                'value' => $model->noibancaycanh ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'vuaphelieu',
                                'value' => $model->vuaphelieu ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'noikhac',
                                'value' => $model->noikhac ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            'noikhac_chitiet'
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-4">{label}</th><td class="col-8">{value}</td></tr>',
                    ]) ?>
                </div>  
            </div>
            <?php endif; ?>
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-success border-bottom pb-2 mb-3">Thông tin nơi làm việc</h6>
                     <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'diachi_noilamviec',
                            $relationPhuongFormat('phuongxa_noilamviec', 'phuongxaNoilamviec'),
                            $relationPhuongFormat('khupho_noilamviec_id', 'khuphoNoilamviec'),
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-4">{label}</th><td class="col-8">{value}</td></tr>',
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <h6 class="text-success border-bottom pb-2 mb-3">Khảo sát lăng quăng</h6>
                     <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'bi_bandau',
                            'ci_bandau'
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-4">{label}</th><td class="col-8">{value}</td></tr>',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
    
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0"> Hướng xử lý</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                           
                            [
                                'attribute' => 'dietlangquang',
                                'value' => $model->dietlangquang ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'giamsat_theodoi',
                                'value' => $model->giamsat_theodoi ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-7">{label}</th><td class="col-5">{value}</td></tr>',
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            
                            [
                                'attribute' => 'xuly_odich_nho',
                                'value' => $model->xuly_odich_nho ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'xuly_odich_dienrong',
                                'value' => $model->xuly_odich_dienrong ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-7">{label}</th><td class="col-5">{value}</td></tr>',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0"> Kết luận</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                           'ketluan_tinhtrang',
                            [
                                'attribute' => 'cabenhchidiem',
                                'value' => $model->cabenhchidiem ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'cabenhthuphat',
                                'value' => $model->cabenhthuphat ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            [
                                'attribute' => 'cadautien',
                                'value' => $model->cadautien ? '<span class="badge bg-danger">Có</span>' : '<span class="badge bg-success">Không</span>',
                                'format' => 'raw',
                            ],
                            $relationFormat('loaiodich__id', 'loaiodich'),
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-7">{label}</th><td class="col-5">{value}</td></tr>',
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'nguoi_dieutra_dichte',
                            'sdt_nguoi_dieutra_dichte',
                            'donvi_dieutra',
                            'email_donvidieutra',
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-7">{label}</th><td class="col-5">{value}</td></tr>',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mb-4">
        <div class="card-header bg-secondary text-white">
            <h5 class="mb-0"> Thông tin thêm</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'phandobenh',
                            'chandoan_bienchung',
                            'doanbenhkem',
                            'benhnen',
                            'ngaykhoiphat',
                            'ngay_xuatvien_chuyenvien_tuvong',
                            'phanloai_chandoan',
                            'tinhtrang_tiemchung',
                            'somuitiem',
                            'tiensu_dichte'
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-7">{label}</th><td class="col-5">{value}</td></tr>',
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'donvi_baocao',
                            'nguoibaocao',
                            'sdt_nguoibaocao',
                            'email_nguoibaocao',
                            'trangthai_baocao',
                            'danhsach_coso_dieutri',
                            'ngay_chinhsua_gannhat',
                            'ngaycapnhat',
                            'phanloai_cabenh',
                            'ngaynhanve',
                            'namnhanve',
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-7">{label}</th><td class="col-5">{value}</td></tr>',
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// CSS tùy chỉnh cho view
$css = <<<CSS
/* Điều chỉnh độ rộng cột label trong DetailView chính */
.ca-benh-view .table-bordered th {
    width: 30%;
}
/* Làm cho DetailView nhỏ gọn hơn trong các cột */
.ca-benh-view .detail-view-compact th,
.ca-benh-view .detail-view-compact td {
    padding-left: 0.5rem;
    padding-right: 0.5rem;
    border: none;
    vertical-align: top;
}
.ca-benh-view .detail-view-compact th {
    font-weight: 500;
}
.ca-benh-view .card-header {
    font-weight: 600;
}
.ca-benh-view .h3 span.fw-normal {
    font-size: 1.25rem;
}
CSS;
$this->registerCss($css);
?>