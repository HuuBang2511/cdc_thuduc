<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\Odich */

$this->title = 'Chi tiết Ổ dịch';
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
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'ngaytaoodich',
            [
                'attribute' => 'xacdinhodich_id',
                'label' => $model->getAttributeLabel('xacdinhodich_id'),
                'value' => function ($model) {
                    return $model->xacdinhodich ? Html::encode($model->xacdinhodich->ten) : null;
                },
                'format' => 'raw',
            ],
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

    <h2 >
        Danh sách Ca bệnh thuộc Ổ dịch
    </h2>

    <?php if (!empty($cabenh)): ?>
        <?= GridView::widget([
            'dataProvider' => new \yii\data\ArrayDataProvider([
                'allModels' => $cabenh,
                'pagination' => [
                    'pageSize' => 10,
                ],
            ]),
            'layout' => "{items}\n{pager}", // Chỉ hiển thị bảng và phân trang
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                [
                    'attribute' => 'id',
                    'label' => 'ID Ca bệnh',
                ],
                [
                    'attribute' => 'hoten',
                    'label' => 'Họ và tên',
                ],
                [
                    'attribute' => 'ngaysinh',
                    'label' => 'Ngày sinh',
                    
                ],
                [
                    'attribute' => 'phuongxa_noiohientai',
                    'label' => 'Phường xã (Nơi ở hiện tại)',
                    'value' => function($cabenh){
                        return ($cabenh->phuongxa_noiohientai) ? $cabenh->phuongxaNoiohientai->ten_dvhc : '';
                    }
                ],
                [
                    'attribute' => 'ngaymacbenh',
                    'label' => 'Ngày mắc bệnh',
                    
                ],
                [
                    'attribute' => 'ngaybaocao',
                    'label' => 'Ngày báo cáo',
                    
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{view}',
                    'buttons' => [
                        'view' => function ($url, $model, $key) {
                            return Html::a('<span class="glyphicon glyphicon-eye-open"></span> Xem', 
                                ['/quanly/cabenh/view', 'id' => $model->id], 
                                ['title' => 'Xem chi tiết Ca bệnh', 'target' => '_blank', 'class' => 'text-indigo-600 hover:text-indigo-800']
                            );
                        },
                    ],
                ],
            ],
            'tableOptions' => [
                // Đã thêm các class Bootstrap tiêu chuẩn để đảm bảo độ rộng 100%
                'class' => 'table table-striped table-bordered w-full border-collapse border border-gray-200 bg-white shadow-lg rounded-lg overflow-hidden'
            ],
            'headerRowOptions' => [
                'class' => 'bg-gray-100 text-gray-600 uppercase text-sm leading-normal'
            ],
            'rowOptions' => [
                'class' => 'hover:bg-gray-50'
            ],
        ]) ?>
    <?php else: ?>
        <p class="text-gray-500 italic">Không có ca bệnh nào được ghi nhận cho ổ dịch này.</p>
    <?php endif; ?>

</div>