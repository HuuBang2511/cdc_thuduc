<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\Truonghoc */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="truonghoc-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gid')->textInput() ?>

    <?= $form->field($model, 'geom')->textInput() ?>

    <?= $form->field($model, 'objectid')->textInput() ?>

    <?= $form->field($model, 'dia_chi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_duong')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_phuong')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_quan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'dien_thoai')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_dv')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ma_truong')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'ten_mien')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'x')->textInput() ?>

    <?= $form->field($model, 'y')->textInput() ?>

    <?= $form->field($model, 'doi_tuong')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'gd_cu')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'checked')->textInput() ?>

    <?= $form->field($model, 'phong_hoc')->textInput() ?>

    <?= $form->field($model, 'lop_hoc')->textInput() ?>

    <?= $form->field($model, 'giao_vien')->textInput() ?>

    <?= $form->field($model, 'hoc_sinh')->textInput() ?>

    <?= $form->field($model, 'maphuong')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'maquan')->textInput(['maxlength' => true]) ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Lưu', ['class' => 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
