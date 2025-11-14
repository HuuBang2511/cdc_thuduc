<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\Odich */

$this->title = 'Chi tiết Ổ dịch: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Quản lý Ổ dịch', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="odich-view">

    <h1 class="text-2xl font-semibold mb-4 text-gray-800">
        <?= Html::encode($this->title) ?>
    </h1>

    <div class="flex space-x-2 mb-4">
        <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300']) ?>
        <?= Html::a('Xóa', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded shadow-md transition duration-300',
            'data' => [
                'confirm' => 'Bạn có chắc chắn muốn xóa mục này không?',
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'ca_benh:ntext',
            [
                'attribute' => 'loaiodich_id',
                'label' => $model->getAttributeLabel('loaiodich_id'),
                'value' => function ($model) {
                    return $model->loaiodich ? Html::encode($model->loaiodich->ten) : null;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'loaibenhdich_id',
                'label' => $model->getAttributeLabel('loaibenhdich_id'),
                'value' => function ($model) {
                    // Giả định bảng danh mục có trường 'ten'
                    return $model->loaibenhdich ? Html::encode($model->loaibenhdich->ten) : null;
                },
                'format' => 'raw',
            ],
            [
                'attribute' => 'truonghoc_id',
                'label' => $model->getAttributeLabel('truonghoc_id'),
                'value' => function ($model) {
                    // Giả định mô hình Truonghoc có trường 'ten'
                    return $model->truonghoc ? Html::encode($model->truonghoc->ten_dv) : null;
                },
                'format' => 'raw',
            ],
            'ngayphathien',
            'ngaykiemtra',
            'ngaydukien_kiemta',
            'ngaybatdau_giamsat',
            'bi_bandau',
            'ci_bandau',
            'hi_bandau',
            'nguoithuchien',
            'dienthoai',
            'nhandinh_gs:ntext',
            [
                'attribute' => 'odichmoi',
                'value' => function ($model) {
                    return $model->odichmoi ? 'Có' : 'Không';
                },
                'label' => 'Ổ dịch mới',
            ],
            'tinhtrangxuly_id', // Hiển thị ID tình trạng xử lý
            'sauxuly',
            'ngaytaoodich'
            
            // Thêm các trường audit nếu có trong QuanlyBaseModel (ví dụ: created_at, created_by)
            // 'created_at:datetime',
            // 'updated_at:datetime',
            // 'created_by',
            // 'updated_by',
        ],
        'options' => [
            'class' => 'table table-striped table-bordered detail-view shadow-lg rounded-lg overflow-hidden'
        ],
    ]) ?>

</div>