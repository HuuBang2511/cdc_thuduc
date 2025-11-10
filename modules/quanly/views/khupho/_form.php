<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\Khupho */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="khupho-form">

    <div class="block block-themed">
        <div class="block-header">
            Khu phố: <?= $model->ten_dvhc  ?>, phường: <?= ($model->phuongxa_id != null) ? $model->phuongxa->ten_dvhc : '' ?>
        </div>
        <div class="block-content">
            <?php $form = ActiveForm::begin(); ?>

            <?= $form->field($model, 'ten_dvhc')->textInput() ?>
        
            <?php if (!Yii::$app->request->isAjax){ ?>
                <div class="form-group">
                    <?= Html::submitButton('Lưu', ['class' => 'btn btn-primary']) ?>
                </div>
            <?php } ?>

            <?php ActiveForm::end(); ?>
    
        </div>
    </div>

    
</div>
