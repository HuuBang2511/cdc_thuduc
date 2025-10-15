<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\CaBenh */

?>
<div class="ca-benh-create">
    <?= $this->render('_form', [
        'model' => $model,
        'categories' => $categories,
    ]) ?>
</div>
