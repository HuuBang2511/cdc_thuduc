<?php

use kartik\editors\Summernote;
use yii\helpers\Url;
use yii\helpers\Html;
use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\web\JsExpression;
use yii\helpers\ArrayHelper;
use kartik\depdrop\DepDrop;

use app\widgets\maskedinput\MaskedInput;

/* @var $this yii\web\View */
/* @var $model app\modules\dost\models\Congviec */
/* @var $form yii\widgets\ActiveForm */

$requestedAction = Yii::$app->requestedAction;
$controller = $requestedAction->controller;
$label = $controller->label;

$this->title = Yii::t('app', $label[$requestedAction->id] . ' ' . $controller->title);
$this->params['breadcrumbs'][] = ['label' => $label['index'], 'url' => Url::to(['index'])];
$this->params['breadcrumbs'][] = $this->title;

?>

<?php
$this->registerCss("
    #thongtin-benhnoikhac, #thongtin-xetnghiem, #cabenh_noikhacchitiet, #cabenh_ngayxuatvien, #thongtin_truonghoc
    , #cabenh_songuoitronggiadinhsxh, #cabenh_songuoitronggiadinhsxhduoi15, #cabenh_songuoitronggiadinh, #cabenh_songuoitronggiadinhduoi15,
    #cabenh-codiachi, #cabenh_dieutra_tcm_truonghoc, #khaosat_sxh, #khaosat_tcm, #cabenh_tcm_chitiet_denkhudongnguoi,#cabenh_tcm_chitiet_tiepxuctacnhan,
    #cabenh_tcm_chitiet_anchungtrenghingo, #cabenh_tcm_chitiet_dungdochoichungtrenghingo, #cabenh_tcm_chitiet_dungvatdungchungtrenghingo, #dieutra_cabenh
    {
        display: none;
    }
    
");
?>

<?php
$script = <<<JS
    function toggleThongTinBenhNoiKhac() {
        var value = $('#cabenh_benhnoikhac').val();
        if (value == '1' || value.toLowerCase() === 'có') {
            $('#thongtin-benhnoikhac').slideDown();
            $('#thongtin-benhnoikhac').css('display', 'flex');
        } else {
            $('#thongtin-benhnoikhac').slideUp();
        }
    }

    function toggleThongTinxetnghiem() {
        var value = $('#laumau_xetnghiem').val();
        if (value == '1')  {
            $('#thongtin-xetnghiem').slideDown();
            $('#thongtin-xetnghiem').css('display', 'flex');
        } else {
            $('#thongtin-xetnghiem').slideUp();
        }
    }

    function toggleNoikhac() {
        var value = $('#cabenh_noikhac').val();
        if (value == '1')  {
            $('#cabenh_noikhacchitiet').slideDown();
            //$('#cabenh_noikhacchitiet').css('display', 'flex');
        } else {
            $('#cabenh_noikhacchitiet').slideUp();
        }
    }

    function toggleTinhtrangKetluan() {
        var value = $('#cabenh_tinhtrangketluan').val();
        if (value == 'Đã xuất viện' || value == 'Đã xuất viện/ tử vong')  {
            $('#cabenh_ngayxuatvien').slideDown();
            //$('#cabenh_noikhacchitiet').css('display', 'flex');
        } else {
            $('#cabenh_ngayxuatvien').slideUp();
        }
    }

    function toggleLoaicabenh() {
        var value = $('#cabenh-loaicabenh_id').val();
        if (value == '2')  {
            $('#thongtin_truonghoc').slideDown();
            $('#thongtin_truonghoc').css('display', 'flex');
        } else {
            $('#thongtin_truonghoc').slideUp();
        }
    }

    function toggleNhacobenhSxh() {
        var value = $('#cabenh_nhacobenhnhansxh').val();
        if (value == '1')  {
            $('#cabenh_songuoitronggiadinhsxh').slideDown();
            $('#cabenh_songuoitronggiadinhsxhduoi15').slideDown();
            //$('#cabenh_noikhacchitiet').css('display', 'flex');
        } else {
            $('#cabenh_songuoitronggiadinhsxh').slideUp();
            $('#cabenh_songuoitronggiadinhsxhduoi15').slideUp();
        }
    }

    function toggleNhacobenh() {
        var value = $('#cabenh_nhacobenhnhan').val();
        if (value == '1')  {
            $('#cabenh_songuoitronggiadinh').slideDown();
            $('#cabenh_songuoitronggiadinhduoi15').slideDown();
            //$('#cabenh_noikhacchitiet').css('display', 'flex');
        } else {
            $('#cabenh_songuoitronggiadinh').slideUp();
            $('#cabenh_songuoitronggiadinhduoi15').slideUp();
        }
    }

    function toggleTcmCodihoc() {
        var value = $('#cabenh_dieutra_tcm_codihoc').val();
        if (value == '1')  {
            $('#cabenh_dieutra_tcm_truonghoc').slideDown();
        } else {
            $('#cabenh_dieutra_tcm_truonghoc').slideUp();
        }
    }

    function toggleCodiachi() {
        var value = $('#cb_codiachi').val();
        if (value == '1')  {
            $('#cabenh-codiachi').slideDown();
            $('#cabenh-codiachi').css('display', 'flex');
        } else {
            $('#cabenh-codiachi').slideUp();
        }
    }

    function toggleLoaibenh() {
        var value = $('#cabenh_loaibenh').val();
        if (value == '1')  {
            $('#khaosat_sxh').slideDown();
            $('#khaosat_sxh').css('display', 'block');
            $('#khaosat_tcm').slideUp();
        }else if(value == '2') {
            $('#khaosat_tcm').slideDown();
            $('#khaosat_tcm').css('display', 'block');
            $('#khaosat_sxh').slideUp();
        }else{
            $('#khaosat_tcm').slideUp();
            $('#khaosat_sxh').slideUp();
        }
    }

    function toggleKhaosatTcmDenkhudongnguoi() {
        var value = $('#cabenh_tcm_denkhudongnguoi').val();
        if (value == '1')  {
            $('#cabenh_tcm_chitiet_denkhudongnguoi').slideDown();
            //$('#cabenh_tcm_chitiet_denkhudongnguoi').css('display', 'flex');
        } else {
            $('#cabenh_tcm_chitiet_denkhudongnguoi').slideUp();
        }
    }

    function toggleKhaosatTcmTiepxuctacnhan() {
        var value = $('#cabenh_tcm_tiepxuctacnhan').val();
        if (value == '1')  {
            $('#cabenh_tcm_chitiet_tiepxuctacnhan').slideDown();
            //$('#cabenh_tcm_chitiet_denkhudongnguoi').css('display', 'flex');
        } else {
            $('#cabenh_tcm_chitiet_tiepxuctacnhan').slideUp();
        }
    }

    function toggleKhaosatTcmAnchungtrenghingo() {
        var value = $('#cabenh_tcm_anchungtrenghingo').val();
        if (value == '1')  {
            $('#cabenh_tcm_chitiet_anchungtrenghingo').slideDown();
            //$('#cabenh_tcm_chitiet_denkhudongnguoi').css('display', 'flex');
        } else {
            $('#cabenh_tcm_chitiet_anchungtrenghingo').slideUp();
        }
    }

    function toggleKhaosatTcmDungdochoichungtrenghingo() {
        var value = $('#cabenh_tcm_dungdochoichungtrenghingo').val();
        if (value == '1')  {
            $('#cabenh_tcm_chitiet_dungdochoichungtrenghingo').slideDown();
            //$('#cabenh_tcm_chitiet_denkhudongnguoi').css('display', 'flex');
        } else {
            $('#cabenh_tcm_chitiet_dungdochoichungtrenghingo').slideUp();
        }
    }

    function toggleKhaosatTcmDungvatdungchungtrenghingo() {
        var value = $('#cabenh_tcm_dungvatdungchungtrenghingo').val();
        if (value == '1')  {
            $('#cabenh_tcm_chitiet_dungvatdungchungtrenghingo').slideDown();
            //$('#cabenh_tcm_chitiet_denkhudongnguoi').css('display', 'flex');
        } else {
            $('#cabenh_tcm_chitiet_dungvatdungchungtrenghingo').slideUp();
        }
    }

    function toggleDieutra() {
        var value = $('#cabenh_isdieutra').val();
        if (value == '1')  {
            $('#dieutra_cabenh').slideDown();
            $('#dieutra_cabenh').css('display', 'block');
            
        }else{
            $('#dieutra_cabenh').slideUp();
        }
    }
    
    toggleThongTinxetnghiem();   
    toggleThongTinBenhNoiKhac();
    toggleNoikhac();
    toggleTinhtrangKetluan();
    toggleLoaicabenh();
    toggleNhacobenhSxh();
    toggleNhacobenh();
    toggleCodiachi();
    toggleTcmCodihoc();
    toggleLoaibenh();
    toggleKhaosatTcmDenkhudongnguoi();
    toggleKhaosatTcmTiepxuctacnhan();
    toggleKhaosatTcmAnchungtrenghingo();
    toggleKhaosatTcmDungdochoichungtrenghingo();
    toggleKhaosatTcmDungvatdungchungtrenghingo();
    toggleDieutra();

    $('#cabenh_isdieutra').on('change', function() {
        toggleDieutra();
        console.log($('#cabenh_isdieutra').val());
    });

    $('#cabenh_tcm_denkhudongnguoi').on('change', function() {
        toggleKhaosatTcmDenkhudongnguoi();
    });

    $('#cabenh_tcm_tiepxuctacnhan').on('change', function() {
        toggleKhaosatTcmTiepxuctacnhan();
    });

    $('#cabenh_tcm_anchungtrenghingo').on('change', function() {
        toggleKhaosatTcmAnchungtrenghingo();
    });

    $('#cabenh_tcm_dungdochoichungtrenghingo').on('change', function() {
        toggleKhaosatTcmDungdochoichungtrenghingo();
    });

    $('#cabenh_tcm_dungvatdungchungtrenghingo').on('change', function() {
        toggleKhaosatTcmDungvatdungchungtrenghingo();
    });

    $('#cabenh_benhnoikhac').on('change', function() {
        toggleThongTinBenhNoiKhac();
    });

    $('#laumau_xetnghiem').on('change', function() {
        toggleThongTinxetnghiem();
        
    });

    $('#cabenh_noikhac').on('change', function() {
        toggleNoikhac(); 
    });

    $('#cb_codiachi').on('change', function() {
        toggleCodiachi();
        console.log($('#cb_codiachi').val())
    });

    $('#cabenh_tinhtrangketluan').on('change', function() {
        toggleTinhtrangKetluan();
    });

    $('#cabenh-loaicabenh_id').on('change', function() {
        toggleLoaicabenh();
        //console.log($('#cabenh-loaicabenh_id').val());
    });

    $('#cabenh_nhacobenhnhansxh').on('change', function() {
        toggleNhacobenhSxh();
        //console.log($('#cabenh_nhacobenhnhansxh').val());
    });

    $('#cabenh_nhacobenhnhan').on('change', function() {
        toggleNhacobenh();

    });

    $('#cabenh_dieutra_tcm_codihoc').on('change', function() {
        toggleTcmCodihoc();
        //console.log($('#cabenh_nhacobenhnhansxh').val());
    });

    $('#cabenh_loaibenh').on('change', function() {
        toggleLoaibenh();
        //console.log($('#cabenh_nhacobenhnhansxh').val());
    });
JS;
$this->registerJs($script);
?>

<div class="row">
    <div class="col-lg-12">
        <div class="block block-themed">
            <div class="block-header">
                <h3 class="block-title"><i class="fa fa-search"></i> <?= $this->title ?></h3>
            </div>
            <div class="block-content">
                <div class="baocao_hangtuan-form">

                    <?php $form = ActiveForm::begin(); ?>


                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'hoten')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'madinhdanh')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaysinh')->widget(MaskedInput::className(), [
                                'options' => [
                                    'disabled' => true,
                                ],
                                'clientOptions' => [
                                    'alias' => 'date',
                                    
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'gioitinh_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['dm_gioitinh'], 'id', 'ten'),
                                'options' => ['prompt' => 'Chọn giới tính', 'disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])->label('Giới tính') ?>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'dantoc_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['dm_dantoc'], 'id', 'ten'),
                                'options' => ['prompt' => 'Chọn dân tộc', 'disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])->label('Dân tộc') ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'loaibenh_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['dm_loaichandoan'], 'id', 'ten'),
                                'options' => ['prompt' => 'Chọn loại bệnh', 'id' => 'cabenh_loaibenh', 'disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ten_nguoibaoho')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaybaocao')->widget(MaskedInput::className(), [
                                'options' => [
                                    'disabled' => true,
                                ],
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaythongbao_cabenh')->widget(MaskedInput::className(), [
                                'options' => [
                                    'disabled' => true,
                                ],
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'so_hsba')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'hinhthuc_dieutri')->widget(Select2::className(), [
                                'data' => $categories['hinhthuc_dieutri'],
                                'options' => ['prompt' => 'Chọn hình thức điều trị', 'disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'loaicabenh_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['dm_loaicabenh'], 'id', 'ten'),
                                'options' => ['prompt' => 'Chọn loại ca bệnh', 'cabenh_loaicabenh'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'coso_dieutri')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'mabenhnhan')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'benhvien_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['benhvien'], 'id', 'tenbenhvien'),
                                'options' => ['prompt' => 'Bệnh viện','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div class="row" id="thongtin_truonghoc">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'truonghoc_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['truonghoc'], 'gid', 'ten_dv'),
                                'options' => ['prompt' => 'Trường học', 'id' => 'truonghoc-id'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'lophoc_id')->widget(DepDrop::class, [
                                    'options'=>['id'=>'lophoc-id'],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true,]],
                                    'pluginOptions'=>[
                                        'depends'=>['truonghoc-id'],
                                        'initialize' => true,
                                        'placeholder'=>'Chọn lớp học',
                                        'url'=>Url::to(['../quanly/categories/get-lophoc']),
                                        'allowClear' => true
                                                
                                    ]
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'truonghoc_phuongxa')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['phuong'], 'ma_dvhc', 'ten_dvhc'),
                                'options' => ['prompt' => 'Phường nơi ở hiện tại', 'id' => 'truonghoc-phuongxa-id'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'truonghoc_khupho_id')->widget(DepDrop::class, [
                                    'options'=>['id'=>'truonghoc-khupho-id'],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true,]],
                                    'pluginOptions'=>[
                                        'depends'=>['truonghoc-phuongxa-id'],
                                        'initialize' => true,
                                        'placeholder'=>'Chọn khu phố',
                                        'url'=>Url::to(['../quanly/categories/get-khupho']),
                                        'allowClear' => true
                                                
                                    ]
                            ]) ?>
                        </div>
                    </div>

                    

                    <h4 class="content-heading">Xác minh ca bệnh</h4>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'codiachi')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => 'Có địa chỉ', 'id' => 'cb_codiachi', 'disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div class="row" id = "cabenh-codiachi">
                        <div class="col-lg-12">
                            <?= $form->field($model, 'diachi_noiohientai')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'phuongxa_noiohientai')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['phuong'], 'ma_dvhc', 'ten_dvhc'),
                                'options' => ['prompt' => 'Phường nơi ở hiện tại', 'id' => 'phuongxa-hientai-id', 'disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'khupho_noiohientai_id')->widget(DepDrop::class, [
                                    'options'=>['id'=>'khupho-hientai-id', 'disabled' => true,],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true,]],
                                    'pluginOptions'=>[
                                        'depends'=>['phuongxa-hientai-id'],
                                        'initialize' => true,
                                        'placeholder'=>'Chọn khu phố',
                                        'url'=>Url::to(['../quanly/categories/get-khupho']),
                                        'allowClear' => true
                                                
                                    ]
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'so_nha')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'tenduong_id')->widget(DepDrop::class, [
                                    'options' => ['id' => 'tenduong-hientai-id', 'disabled' => true],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
                                        'depends' => ['khupho-hientai-id'],          
                                        'placeholder' => 'Chọn tên đường',
                                        'url' => Url::to(['/quanly/categories/get-tenduong']),
                                        'initialize' => false,
                                        'allowClear' => true,
                                    ],
                            ]) ?>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'loai_ca_benh')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'xacminh_cabenh')->widget(Select2::className(), [
                                'data' => $categories['xacminhcabenh'],
                                'options' => ['prompt' => 'Xác minh ca bệnh', 'disabled' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'diachi_xacminh_cabenh')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'phuongxa_xacminhcabenh')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['phuong'], 'ma_dvhc', 'ten_dvhc'),
                                'options' => ['prompt' => 'Phường xã xác minh ca bệnh', 'id' => 'phuongxa-xacminhcabenh-id', 'disabled' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'khupho_xacminh_cabenh_id')->widget(DepDrop::class, [
                                    'options'=>['id'=>'khupho-xacminhcabenh-id', 'disabled' => true],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true,]],
                                    'pluginOptions'=>[
                                        'depends'=>['phuongxa-xacminhcabenh-id'],
                                        'initialize' => true,
                                        'placeholder'=>'Chọn khu phố',
                                        'url'=>Url::to(['../quanly/categories/get-khupho']),
                                        'allowClear' => true
                                                
                                    ]
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'chandoanchinh_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['dm_loaichandoan'], 'id', 'ten'),
                                'options' => ['prompt' => 'Chọn chẩn đoán', 'disabled' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaymacbenh')->widget(MaskedInput::className(), [
                                'options' => [
                                    'disabled' => true,
                                ],
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'tinhtrang_xuatvien')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => 'Tình trạng xuất viện', 'disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'tamtru')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => 'Tạm trú', 'disabled' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <?= $form->field($model, 'xacminh_xuly')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'benhnoikhac')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => 'Bệnh nơi khác', 'id' => 'cabenh_benhnoikhac', 'disabled' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div class="row" id="thongtin-benhnoikhac">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'sonha_benhnoikhac')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'phuongxa_benhnoikhac')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['phuong'], 'ma_dvhc', 'ten_dvhc'),
                                'options' => ['prompt' => 'Phường bệnh nơi khác', 'id' => 'phuongxa-benhnoikhac-id', 'disabled' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'khupho_benhnoikhac_id')->widget(DepDrop::class, [
                                    'options'=>['id'=>'khupho-benhnoikhac-id', 'disabled' => true],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true,]],
                                    'pluginOptions'=>[
                                        'depends'=>['phuongxa-benhnoikhac-id'],
                                        'initialize' => true,
                                        'placeholder'=>'Chọn khu phố',
                                        'url'=>Url::to(['../quanly/categories/get-khupho']),
                                        'allowClear' => true
                                                
                                    ]
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'tenduong_benhnoikhac_id')->widget(DepDrop::class, [
                                    'options' => ['id' => 'tenduong-benhnoikhac-id', 'disabled' => true],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true]],
                                    'pluginOptions' => [
                                        'depends' => ['khupho-benhnoikhac-id'],          
                                        'placeholder' => 'Chọn tên đường',
                                        'url' => Url::to(['/quanly/categories/get-tenduong']),
                                        'initialize' => false,
                                        'allowClear' => true,
                                    ],
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'songuoi_cutrru_giadinh')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'songuoi_cutru_giadinh_duoi15')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'is_dieutra')->widget(Select2::className(), [
                                'data' => $categories['chondieutra'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_isdieutra', 'disabled' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div id = "dieutra_cabenh">

                    <h4 class="content-heading">Điều tra dịch tể</h4>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'thanhpho_baove')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => 'Thành phố báo về', 'disabled' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'phathien_congdong')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => 'Phát hiện cộng đồng', 'id' => 'cabenh_phcd', 'disabled' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'conhapvien')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => 'Có nhập viện', 'disabled' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'benhviennhap_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['benhvien'], 'id', 'tenbenhvien'),
                                'options' => ['prompt' => 'Bệnh viện', 'disabled' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        
                        <div class="col-lg-6">
                            <?= $form->field($model, 'ngaynhapvien')->widget(MaskedInput::className(), [
                                'options' => [
                                    'disabled' => true,
                                ],
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'nghenghiep')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngay_dieutra_dichte')->widget(MaskedInput::className(), [
                                'options' => [
                                    'disabled' => true,
                                ],
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'laymau_xetnghiem')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => 'Có xét nghiệm', 'id' => 'laumau_xetnghiem', 'disabled' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>
                    <div class="row" id="thongtin-xetnghiem">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'loaibenhpham')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'donvi_thuchien_xetnghiem')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaylaymau')->widget(MaskedInput::className(), [
                                'options' => [
                                    'disabled' => true,
                                ],
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                           
                            <?= $form->field($model, 'loaixetnghiem')->widget(Select2::className(), [
                                'data' => $categories['loaixetnghiem'],
                                'options' => ['prompt' => 'Loại xét nghiệm', 'disabled' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ketqua_xetnghiem')->widget(Select2::className(), [
                                'data' => $categories['ketquaxetnghiem'],
                                'options' => ['prompt' => 'Kết quả xét nghiệm', 'disabled' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'diachi_noilamviec')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'phuongxa_noilamviec')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['phuong'], 'ma_dvhc', 'ten_dvhc'),
                                'options' => ['prompt' => 'Phường nơi ở hiện tại', 'id' => 'phuongxa-noilamviec-id', 'disabled' => true],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'khupho_noilamviec_id')->widget(DepDrop::class, [
                                    'options'=>['id'=>'khupho-noilamviec-id', 'disabled' => true],
                                    'type' => DepDrop::TYPE_SELECT2,
                                    'select2Options' => ['pluginOptions' => ['allowClear' => true,]],
                                    'pluginOptions'=>[
                                        'depends'=>['phuongxa-noilamviec-id'],
                                        'initialize' => true,
                                        'placeholder'=>'Chọn khu phố',
                                        'url'=>Url::to(['../quanly/categories/get-khupho']),
                                        'allowClear' => true
                                                
                                    ]
                            ]) ?>
                        </div>
                    </div>

                    <h4 class="content-heading">Thông tin khảo sát</h4>


                    <div id = "khaosat_sxh">

                    

                    <h7>Tại nơi làm việc, trong vòng 2 tuần qua có ai bị SXH / nghi ngờ SXH / sốt không?</h7>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'trong_haituan_bisxh')->widget(Select2::className(), [
                                'data' => $categories['chonchuaxacdinh'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <h7>Trong vòng 2 tuần trước khi bị bệnh, BN có đi đến hay thường đến những nơi nào sau đây (đánh dấu
                        nhiều ô):</h7>

                    <div class="row">
                        <div class="col-lg-2">
                            <?= $form->field($model, 'nhaco_benhnhan_sxh')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'nhaco_nguoibenh')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'benhvien_phongkham')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'nhatho')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'dinhchua')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'congvien')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <?= $form->field($model, 'noihoihop')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'noixaydung')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'quancaphe')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'noichannuoi')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'noibancaycanh')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-2">
                            <?= $form->field($model, 'vuaphelieu')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2">
                            <?= $form->field($model, 'noikhac')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_noikhac','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-10" id="cabenh_noikhacchitiet">
                            <?= $form->field($model, 'noikhac_chitiet')->textInput() ?>
                        </div>
                    </div>

                    <h7>Trong vòng 1 tháng qua, tại gia đình</h7>

                    <div class="row">
                        <div class="col-lg-2">
                            <?= $form->field($model, 'nha_cabenh')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_nhacobenhnhansxh','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-5" id="cabenh_songuoitronggiadinhsxh">
                            <?= $form->field($model, 'songuoi_tronggiadinh_sxh')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-5" id="cabenh_songuoitronggiadinhsxhduoi15">
                            <?= $form->field($model, 'songuoi_duoi15_sxh')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-2">
                            <?= $form->field($model, 'nha_couongthuoc_sxh')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_nhacobenhnhan','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-5" id="cabenh_songuoitronggiadinh">
                            <?= $form->field($model, 'songuoi_giadinh_macbenh')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-5" id="cabenh_songuoitronggiadinhduoi15">
                            <?= $form->field($model, 'songuoi_giadinh_macbenh_duoi15')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>
                    
                    </div>

                    <div id="khaosat_tcm">
                    
                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'dieutra_tcm_codihoc')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_dieutra_tcm_codihoc','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3" id="cabenh_dieutra_tcm_truonghoc">
                            <?= $form->field($model, 'dieutra_tcm_truonghoc_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['truonghoc'], 'gid', 'ten_dv'),
                                'options' => ['prompt' => 'Trường học','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'trong1thang_tiepxuc_tcm_truonghoc')->widget(Select2::className(), [
                                'data' => $categories['chonchuaxacdinh'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'tiepxuc_tcm')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'dinhatre_tcm')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'tiepxuc_nguoichamsoc_tcm')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'denkhudongnguoi_tcm')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_tcm_denkhudongnguoi','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-9" id="cabenh_tcm_chitiet_denkhudongnguoi">
                            <?= $form->field($model, 'chitiet_denkhudongnguoi')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'tiepxuc_tacnhan_gaynhiem_tcm')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_tcm_tiepxuctacnhan','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-9" id="cabenh_tcm_chitiet_tiepxuctacnhan">
                            <?= $form->field($model, 'chitiet_tacnhan_tiepxuc_tcm')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <?= $form->field($model, 'nguonnuoc_sudung_tcm')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'anchung_tre_nghingo_tcm')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_tcm_anchungtrenghingo','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-9" id="cabenh_tcm_chitiet_anchungtrenghingo">
                            <?= $form->field($model, 'chitiet_anchung_tre_nghingo_tcm')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'dungdochoi_chung_tre_nghingo_tcm')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_tcm_dungdochoichungtrenghingo','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-9" id="cabenh_tcm_chitiet_dungdochoichungtrenghingo">
                            <?= $form->field($model, 'chitiet_dungdochoichung_tre_nghingo_tcm')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'dungchung_vatdung_tre_nghingo_tcm')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_tcm_dungvatdungchungtrenghingo','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-9" id="cabenh_tcm_chitiet_dungvatdungchungtrenghingo">
                            <?= $form->field($model, 'chitiet_dungchung_vatdung_tre_nghingo_tcm')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'trong1thang_tiepxuc_giadinh_tcm')->widget(Select2::className(), [
                                'data' => $categories['chonchuaxacdinh'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'songuoi_bi_tcm_giadinh')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'songuoi_bi_tcm_giadinh_duoi15')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'sotogiapranh_khaosat_tcm')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'sotokhaosat_tcm')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'khaosat_tcm_cocabenh_sxh')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_tcm_khaosatcabenhsxh','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3" id="cabenh_tcm_socakhaosatsxh">
                            <?= $form->field($model, 'soca_khaosat_tcm_benhsxh')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>
                        
                    </div>

                    <h4 class="content-heading">Khảo sát lăng quăng</h4>
                    <p>Khảo sát khi ca bệnh là ca chỉ điểm / ca đầu tiên.</p>
                    <ul>
                        <li>Mục đích khảo sát là để có quyết định xử lý như ổ dịch nhỏ hay không.</li>
                        <li>Nếu là các ca thứ phát chỉ khảo sát trong quá trình xử lý ổ dịch.</li>
                    </ul>
                    <p>Khảo sát nhà ca bệnh và 15 nhà chung quanh theo mẫu khảo sát lăng quăng.</p>
                    <div class="row">
                        <div class="col-lg-6" >
                            <?= $form->field($model, 'bi_bandau')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-6" >
                            <?= $form->field($model, 'ci_bandau')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <h4 class="content-heading">Hướng xử lý</h4>

                    

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'dietlangquang')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'giamsat_theodoi')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'xuly_odich_nho')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_xulyodich','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'xuly_odich_dienrong')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_xulyodich_dienrong','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'odichmoi')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'odichcu')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'odichcu_xuly')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'xuly')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'xuly_ngay')->widget(MaskedInput::className(), [
                                'options' => [
                                    'disabled' => true,
                                ],
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                    </div>

                    </div>

                    <h4 class="content-heading">Kết luận</h4>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'cabenhchidiem')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_cabenhchidiem','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'cabenhthuphat')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_cabenhthuphat','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'cadautien')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => '', 'id' => 'cabenh_cabenhdautien','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ketluan_tinhtrang')->widget(Select2::className(), [
                                'data' => $categories['ketluan'],
                                'options' => ['prompt' => 'Chọn tình trạng kết luận', 'id' => 'cabenh_tinhtrangketluan','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3" id = 'cabenh_ngayxuatvien'>
                            <?= $form->field($model, 'ketluan_ngayxuatvien')->widget(MaskedInput::className(), [
                                'options' => [
                                    'disabled' => true,
                                ],
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-6" >
                            <?= $form->field($model, 'ketluan_chandoan')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'loaiodich__id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['dm_loaiodich'], 'id', 'ten'),
                                'options' => ['prompt' => 'Chọn kết luận loại ổ dịch','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>
                            
                    <i>
                        * Điều tra ghi phiếu đầy đủ và không bỏ sót bất kỳ nội dung nào. <br>
                        * Mẫu phiếu được thực hiện:  ca bệnh thông báo khi bệnh nhân có ở tại nhà, cư trú có thể ở bất cứ nơi đâu, bệnh sốt xuất huyết hay là bệnh khác.
                    </i>

                    <div class="row">
                        <div class="col-lg-6" >
                            <?= $form->field($model, 'nguoi_dieutra_dichte')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-6" >
                            <?= $form->field($model, 'sdt_nguoi_dieutra_dichte')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6" >
                            <?= $form->field($model, 'donvi_dieutra')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-6" >
                            <?= $form->field($model, 'email_donvidieutra')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <h4 class="content-heading">Thông tin</h4>

                    <div class="row">
                        <div class="col-lg-12" >
                            <?= $form->field($model, 'phandobenh')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12" >
                            <?= $form->field($model, 'chandoan_bienchung')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12" >
                            <?= $form->field($model, 'doanbenhkem')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12" >
                            <?= $form->field($model, 'benhnen')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaykhoiphat')->widget(MaskedInput::className(), [
                                'options' => [
                                    'disabled' => true,
                                ],
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngay_xuatvien_chuyenvien_tuvong')->widget(MaskedInput::className(), [
                                'options' => [
                                    'disabled' => true,
                                ],
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-6" >
                            <?= $form->field($model, 'phanloai_chandoan')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3" >
                            <?= $form->field($model, 'tinhtrang_tiemchung')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3" >
                            <?= $form->field($model, 'somuitiem')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12" >
                            <?= $form->field($model, 'tiensu_dichte')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'donvi_baocao')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'nguoibaocao')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'sdt_nguoibaocao')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'email_nguoibaocao')->textInput(['disabled' => true]) ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'trangthai_baocao')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-12" >
                            <?= $form->field($model, 'danhsach_coso_dieutri')->textarea(['rows' => 3, 'disabled' => true]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngay_chinhsua_gannhat')->widget(MaskedInput::className(), [
                                'options' => [
                                    'disabled' => true,
                                ],
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaycapnhat')->widget(MaskedInput::className(), [
                                'options' => [
                                    'disabled' => true,
                                ],
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'phanloai_cabenh')->widget(Select2::className(), [
                                'data' => $categories['phanloaicabenh'],
                                'options' => ['prompt' => 'Phân loại ca bệnh','disabled' => true,],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <h4 class="content-heading">Nhận về</h4>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaynhanve')->widget(MaskedInput::className(), [
                                'options' => [
                                    'disabled' => true,
                                ],
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'namnhanve')->textInput(['disabled' => true]) ?>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-12 pb-3">
                            <?= Html::submitButton('Lưu', ['class' => 'btn btn-primary']) ?>

                            <a href="javascript:window.history.back()" class="btn btn-light float-end">
                                <i class="fa fa-fw fa-angle-left"></i> Quay lại
                            </a>
                        </div>
                    </div>

                    <?php ActiveForm::end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>