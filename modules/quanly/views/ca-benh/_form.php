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
    #thongtin-benhnoikhac {
        display: none;
    }
    #cabenh-benhvien {
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

    function toggleThanhphobaove() {
        var value = $('#cabenh_tpbv').val();
        if (value == '1' || value.toLowerCase() === 'có') {
            $('#cabenh-benhvien').slideDown();
            //$('#cabenh-benhvien').css('display', 'flex');
        } else {
            $('#cabenh-benhvien').slideUp();
        }
    }

    
    toggleThongTinBenhNoiKhac();
    toggleThanhphobaove();

    $('#cabenh_benhnoikhac').on('change', function() {
        toggleThongTinBenhNoiKhac();
    });

    $('#cabenh_tpbv').on('change', function() {
        toggleThanhphobaove();
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
                            <?= $form->field($model, 'hoten')->textInput() ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaysinh')->widget(MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'gioitinh_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['dm_gioitinh'], 'id', 'ten'),
                                'options' => ['prompt' => 'Chọn giới tính'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])->label('Giới tính') ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'dantoc_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['dm_dantoc'], 'id', 'ten'),
                                'options' => ['prompt' => 'Chọn dân tộc'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])->label('Dân tộc') ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'loaibenh_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['dm_loaichandoan'], 'id', 'ten'),
                                'options' => ['prompt' => 'Chọn loại bệnh'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ten_nguoibaoho')->textInput() ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaybaocao')->widget(MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaythongbao_cabenh')->widget(MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'so_hsba')->textInput() ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'hinhthuc_dieutri')->widget(Select2::className(), [
                                'data' => $categories['hinhthuc_dieutri'],
                                'options' => ['prompt' => 'Chọn hình thức điều trị'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>
                    
                    <h4 class="content-heading">Xác minh ca bệnh</h4>

                    <div class="row">
                        <div class="col-lg-12">
                            <?= $form->field($model, 'diachi_noiohientai')->textInput() ?>    
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'phuongxa_noiohientai')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['phuong'], 'ma_dvhc', 'ten_dvhc'),
                                'options' => ['prompt' => 'Phường nơi ở hiện tại', 'id' => 'phuongxa-hientai-id'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'khupho_noiohientai_id')->widget(DepDrop::class, [
                                    'options'=>['id'=>'khupho-hientai-id'],
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
                            <?= $form->field($model, 'so_nha')->textInput() ?>    
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'tenduong_id')->widget(DepDrop::class, [
                                    'options' => ['id' => 'tenduong-hientai-id'],
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
                            <?= $form->field($model, 'benhnoikhac')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => 'Bệnh nơi khác', 'id' => 'cabenh_benhnoikhac'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>  

                    <div class="row" id="thongtin-benhnoikhac">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'sonha_benhnoikhac')->textInput() ?>    
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'phuongxa_benhnoikhac')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['phuong'], 'ma_dvhc', 'ten_dvhc'),
                                'options' => ['prompt' => 'Phường bệnh nơi khác', 'id' => 'phuongxa-benhnoikhac-id'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'khupho_benhnoikhac_id')->widget(DepDrop::class, [
                                    'options'=>['id'=>'khupho-benhnoikhac-id'],
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
                                    'options' => ['id' => 'tenduong-benhnoikhac-id'],
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
                            <?= $form->field($model, 'songuoi_cutrru_giadinh')->textInput() ?>    
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'songuoi_cutru_giadinh_duoi15')->textInput() ?>    
                        </div>
                    </div>

                    <h4 class="content-heading">Điều tra dịch tể</h4>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'thanhpho_baove')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => 'Thành phố báo về', 'id' => 'cabenh_tpbv'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-9" id="cabenh-benhvien">
                            <?= $form->field($model, 'benhvien_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['benhvien'], 'id', 'tenbenhvien'),
                                'options' => ['prompt' => 'Bệnh viện'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div> 

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaymacbenh')->widget(MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaynhapvien')->widget(MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-6">
                            <?= $form->field($model, 'nghenghiep')->textInput() ?>    
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <?= $form->field($model, 'diachi_noilamviec')->textInput() ?>    
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'phuongxa_noilamviec')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['phuong'], 'ma_dvhc', 'ten_dvhc'),
                                'options' => ['prompt' => 'Phường nơi ở hiện tại', 'id' => 'phuongxa-noilamviec-id'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'khupho_noilamviec_id')->widget(DepDrop::class, [
                                    'options'=>['id'=>'khupho-noilamviec-id'],
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