<?php

use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

?>

<div class="row">
    <div class="col-lg-12">
        <div class="block block-themed">
            <div class="block-header">
                <h5 class="m-0">
                    <i class="fa fa-search light"></i> Tìm kiếm ca bệnh
                </h5>
            </div>
            <div class="block-content">
                <?php
                $form = ActiveForm::begin([]);
                ?>
                <div class="row">
                    <div class="col-lg-3">
                        <?= $form->field($searchModel, 'hoten')->input('text') ?>
                    </div>
                    <div class="col-lg-3">
                        <?=
                        $form->field($searchModel, 'gioitinh_id')->widget(Select2::className(), [
                            'data' => ArrayHelper::map($categories['dm_gioitinh'], 'id', 'ten'),
                            'options' => ['prompt' => 'Chọn giới tính'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-lg-3">
                        <?=
                        $form->field($searchModel, 'dantoc_id')->widget(Select2::className(), [
                            'data' => ArrayHelper::map($categories['dm_dantoc'], 'id', 'ten'),
                            'options' => ['prompt' => 'Chọn dân tộc'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-lg-3">
                        <?=
                        $form->field($searchModel, 'loaibenh_id')->widget(Select2::className(), [
                            'data' => ArrayHelper::map($categories['dm_loaichandoan'], 'id', 'ten'),
                            'options' => ['prompt' => 'Chọn loại bệnh'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <?=
                        $form->field($searchModel, 'loaicabenh_id')->widget(Select2::className(), [
                            'data' => ArrayHelper::map($categories['dm_loaicabenh'], 'id', 'ten'),
                            'options' => ['prompt' => 'Chọn loại ca bệnh'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-lg-3">
                        <?=
                        $form->field($searchModel, 'chandoanchinh_id')->widget(Select2::className(), [
                            'data' => ArrayHelper::map($categories['dm_loaichandoan'], 'id', 'ten'),
                            'options' => ['prompt' => 'Chọn chẩn đoán chính'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-lg-3">
                        <?=
                        $form->field($searchModel, 'chandoan_bandau_id')->widget(Select2::className(), [
                            'data' => ArrayHelper::map($categories['dm_loaichandoan'], 'id', 'ten'),
                            'options' => ['prompt' => 'Chọn chẩn đoán chính'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-lg-3">
                        <?=
                        $form->field($searchModel, 'phuongxa')->widget(Select2::className(), [
                            'data' => ArrayHelper::map($categories['phuong'], 'ma_dvhc', 'ten_dvhc'),
                            'options' => ['prompt' => 'Chọn phường'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <?= $form->field($searchModel, 'date_from')->widget(DatePicker::className(), [
                            'pluginOptions' => [
                                'format' => 'dd/mm/yyyy',
                                'autoclose' => true,
                            ],
    //                        'language' => 'vn',
                            'options' => ['placeholder' => 'Ngày báo cáo từ'],
                        ]) ?>
                    </div>
                    <div class="col-md-3">
                        <?= $form->field($searchModel, 'date_to')->widget(DatePicker::className(), [
                            'pluginOptions' => [
                                'format' => 'dd/mm/yyyy',
                                'autoclose' => true,
                            ],
    //                        'language' => 'vn',
                            'options' => ['placeholder' => 'Ngày báo cáo đến'],
                        ]) ?>
                    </div>
                    <div class="col-lg-3">
                        <?=
                        $form->field($searchModel, 'tinhtrang_dieutra')->widget(Select2::className(), [
                            'data' => $categories['tinhtrangdieutra'],
                            'options' => ['prompt' => 'Chọn tình trạng điều tra'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-lg-3">
                        <?=
                        $form->field($searchModel, 'tiendo_dieutra')->widget(Select2::className(), [
                            'data' => $categories['tiendodieutra'],
                            'options' => ['prompt' => 'Chọn tiến độ điều tra'],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= $form->field($searchModel, 'diachi_noiohientai')->input('text') ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 pb-3">
                        <div class="float-end">
                            <?= Html::submitButton('Tìm kiếm', ['class' => 'btn btn-info']) ?>
                        </div>
                    </div>
                </div>

                <?php ActiveForm::end() ?>
            </div>
        </div>
    </div>
</div>