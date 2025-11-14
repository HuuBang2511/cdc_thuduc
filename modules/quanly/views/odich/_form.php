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
                            <?= $form->field($model, 'ngaykiemtra')->widget(MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngayphathien')->widget(MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaydukien_kiemta')->widget(MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'loaiodich_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['dm_loaiodich'], 'id', 'ten'),
                                'options' => ['prompt' => 'Chọn Loại ổ dịch'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])?>
                        </div>
                        
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaybatdau_giamsat')->widget(MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'bi_bandau')->textInput() ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ci_bandau')->textInput() ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'hi_bandau')->textInput() ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'truonghoc_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['truonghoc'], 'gid', 'ten_dv'),
                                'options' => ['prompt' => 'Chọn trường học'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ])?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'odichmoi')->widget(Select2::className(), [
                                'data' => $categories['chon'],
                                'options' => ['prompt' => ''],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'tinhtrangxuly_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['dm_tinhtrangxuly'], 'id', 'ten'),
                                'options' => ['prompt' => 'Chọn tình trạng xử lý'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-3">
                            <?= $form->field($model, 'ngaytaoodich')->widget(MaskedInput::className(), [
                                'clientOptions' => [
                                    'alias' => 'date'
                                ],
                            ]); ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'nguoithuchien')->textInput() ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'dienthoai')->textInput() ?>
                        </div>
                        <div class="col-lg-3">
                            <?= $form->field($model, 'xacdinhodich_id')->widget(Select2::className(), [
                                'data' => ArrayHelper::map($categories['dm_xacdinhodich'], 'id', 'ten'),
                                'options' => ['prompt' => 'Chọn loại xác định ổ dịch'],
                                'pluginOptions' => [
                                    'allowClear' => true
                                ],
                            ]) ?>
                        </div>
                    </div>                

                    <div class="row">
                        <div class="col-lg-12" >
                            <?= $form->field($model, 'nhandinh_gs')->textarea(['rows' => 3]) ?>
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