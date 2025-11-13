<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\Odich */
?>
<div class="odich-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
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
            'nhandinh_gs:ntext',
            'truonghoc_id',
            'loaibenhdich_id',
            'lophoc_id',
            'odichmoi:boolean',
            'tinhtrangxuly_id',
            'sauxuly',
            'ngaytaoodich'
        ],
    ]) ?>

</div>
