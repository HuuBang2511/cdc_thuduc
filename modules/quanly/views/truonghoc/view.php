<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\Truonghoc */
?>
<div class="truonghoc-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
        ],
    ]) ?>

</div>
