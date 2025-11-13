<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\Odich */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="odich-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'ca_benh')->textInput() ?>

    <?= $form->field($model, 'loaiodich_id')->textInput() ?>

    <?= $form->field($model, 'ngayphathien')->textInput() ?>

    <?= $form->field($model, 'ngaykiemtra')->textInput() ?>

    <?= $form->field($model, 'ngaydukien_kiemta')->textInput() ?>

    <?= $form->field($model, 'ngaybatdau_giamsat')->textInput() ?>

    <?= $form->field($model, 'bi_bandau')->textInput() ?>

    <?= $form->field($model, 'ci_bandau')->textInput() ?>

    <?= $form->field($model, 'hi_bandau')->textInput() ?>

    <?= $form->field($model, 'nguoithuchien')->textInput() ?>

    <?= $form->field($model, 'dienthoai')->textInput() ?>

    <?= $form->field($model, 'nhandinh_gs')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'truonghoc_id')->textInput() ?>

    <?= $form->field($model, 'loaibenhdich_id')->textInput() ?>

    <?= $form->field($model, 'lophoc_id')->textInput() ?>

    <?= $form->field($model, 'odichmoi')->checkbox() ?>

    <?= $form->field($model, 'tinhtrangxuly_id')->textInput() ?>

    <?= $form->field($model, 'sauxuly')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton('Lưu', ['class' => 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
