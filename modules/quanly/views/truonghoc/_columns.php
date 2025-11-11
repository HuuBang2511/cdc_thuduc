<?php
use yii\helpers\Url;
use yii\helpers\Html;

return [
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    //     [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'gid',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'geom',
    // ],
    // [
    //     'class'=>'\kartik\grid\DataColumn',
    //     'attribute'=>'objectid',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_dv',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'dia_chi',
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'ten_duong',
    ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ten_phuong',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ten_quan',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'dien_thoai',
    // ],
    
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ma_truong',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'ten_mien',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'x',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'y',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'doi_tuong',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'gd_cu',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'checked',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'phong_hoc',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'lop_hoc',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'giao_vien',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'hoc_sinh',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'created_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'updated_at',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'maphuong',
    // ],
    // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'maquan',
    // ],
    // [
    //     'class' => 'kartik\grid\ActionColumn',
    //     'dropdown' => false,
    //     'vAlign'=>'middle',
    //     'width' => '180px',
    //     'urlCreator' => function($action, $model, $key, $index) { 
    //             return Url::to([$action,'id'=>$key]);
    //     },
    //     'buttons' => [
    //         'view' => function ($url, $model, $key) {
    //             return Html::a('<span class="fa fa-info"></span>',$url,['class' => 'btn btn-info btn-sm','role' => 'modal-remote','title'=>'Xem']);
    //         },
    //         'update' => function ($url, $model, $key) {
    //             return Html::a('<span class="fa fa-pen"></span>',$url,['class' => 'btn btn-warning btn-sm','role' => 'modal-remote','title'=>'Cập nhật']);
    //         },
    //         'delete' => function ($url, $model, $key) {
    //             return Html::a('<span class="fa fa-trash"></span>',$url,['class' => 'btn btn-danger btn-sm','role' => 'modal-remote','title'=>'Xóa']);
    //         },
    //     ],
    // ],

];   