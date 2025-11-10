<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\BenhVien */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="benh-vien-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tenbenhvien')->textInput() ?>

    <?= $form->field($model, 'maso')->textInput() ?>

    <?= $form->field($model, 'tenvt')->textInput() ?>

    <?= $form->field($model, 'diachi')->textInput() ?>

    <?= $form->field($model, 'ma_bv')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Lưu', ['class' => 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
