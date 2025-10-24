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
    $value = $relation ? $relation->ten : null;
    if($attribute == 'truonghoc_id'){
        $value = $relation ? $relation->ten_dv : null;
    }
    if($attribute == 'lophoc_id'){
        $value = $relation ? $relation->tenlop : null;
    }
    if($attribute == 'benhvien_id'){
        $value = $relation ? $relation->tenbenhvien : null;
    }
    return [
        'attribute' => $attribute,
        'value' => $value, 
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
        <div>
            <?= Html::a('<i class="fas fa-edit me-1"></i> ' . Yii::t('app', 'Cập nhật'), ['update', 'id' => $model->id], ['class' => 'btn btn-warning me-2']) ?>
            <?= Html::a('<i class="fas fa-trash-alt me-1"></i> ' . Yii::t('app', 'Xóa'), ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => Yii::t('app', 'Bạn có chắc chắn muốn xóa mục này?'),
                    'method' => 'post',
                ],
            ]) ?>
             <a href="javascript:window.history.back()" class="btn btn-light float-end ms-2">
                <i class="fa fa-fw fa-angle-left me-1"></i> <?= Yii::t('app', 'Quay lại') ?>
            </a>
        </div>
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
                            'ngaymacbenh',
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
            </div>
        </div>
    </div>
    <div class="card shadow-sm mb-4">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="fas fa-school me-2"></i> Thông tin học tập và lịch sử bệnh</h5>
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
                            $relationFormat('truonghoc_khupho_id', 'truonghocKhupho'),
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
            <h5 class="mb-0"><i class="fas fa-home me-2"></i> Thông tin gia đình và ghi chú</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="text-secondary border-bottom pb-2 mb-3">Thông tin Gia đình</h6>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'songuoitronggiadinh',
                            'songuoitronggiadinhduoi15',
                            'songuoitronggiadinhsxh',
                            'songuoitronggiadinhsxhduoi15',
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-7">{label}</th><td class="col-5">{value}</td></tr>',
                    ]) ?>
                </div>
                <div class="col-md-6">
                    <h6 class="text-secondary border-bottom pb-2 mb-3">Ghi chú</h6>
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'ghichu:ntext',
                        ],
                        'options' => ['class' => 'table table-sm table-borderless detail-view-compact'],
                        'template' => '<tr><th class="col-3">{label}</th><td class="col-9">{value}</td></tr>',
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