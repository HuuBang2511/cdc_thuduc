<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\modules\quanly\models\CaBenh */

// Lấy thông tin từ Controller (giả định)
$requestedAction = Yii::$app->requestedAction;
$controller = $requestedAction->controller;
$label = $controller->label;

$this->title = Yii::t('app', $label[$requestedAction->id] . ' ' . $controller->title);
$this->params['breadcrumbs'][] = ['label' => $label['index'], 'url' => Url::to(['index'])];
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="odich-tcm-view container">

    <h3 class="mb-3"><?= Html::encode($this->title) ?></h3>

    <div class="card mb-4">
        <div class="card-header bg-primary text-white">
            <strong>Thông tin ca bệnh gốc</strong>
        </div>
        <div class="card-body">
            <p><strong>Họ tên:</strong> <?= Html::encode($model->hoten) ?></p>
            <p><strong>Ngày báo cáo:</strong> <?= Html::encode($model->ngaybaocao) ?></p>
            <p><strong>Ngày mắc bệnh:</strong> <?= Html::encode($model->ngaymacbenh) ?></p>
            <?php if ($model->truonghoc_id): ?>
                <p><strong>Trường học:</strong> <?= Html::encode($model->truonghoc->ten_dv ?? '') ?></p>
            <?php endif; ?>
            <p><strong>Loại bệnh:</strong> <?= Html::encode($model->loaibenh->ten ?? '') ?></p>
            <p><strong>Loại ca bệnh:</strong> <?= Html::encode($model->loaicabenh->ten ?? '') ?></p>
        </div>
    </div>

    <div class="card">
        <div class="card-header bg-success text-white">
            <strong>Danh sách ca bệnh liên quan (trong ±7 ngày)</strong>
        </div>
        <div class="card-body">
            <?php if (!empty($cabenh_lienquan)): ?>
                <table class="table table-bordered table-striped table-sm">
                    <thead class="table-success">
                        <tr>
                            <th style="width: 40%">Họ tên</th>
                            <th style="width: 30%">Ngày mắc bệnh</th>
                            <th style="width: 30%">Ngày báo cáo</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($cabenh_lienquan as $cb): ?>
                            <tr>
                                <td>
                                    <?= Html::a(Html::encode($cb['hoten']), ['cabenh/view', 'id' => $cb['id']], ['target' => '_blank']) ?>
                                </td>
                                <td>
                                    <?= !empty($cb['ngaymacbenh']) 
                                        ? Yii::$app->formatter->asDate($cb['ngaymacbenh'], 'php:d/m/Y') 
                                        : '' ?>
                                </td>
                                <td>
                                    <?= !empty($cb['ngaybaocao']) 
                                        ? Yii::$app->formatter->asDate($cb['ngaybaocao'], 'php:d/m/Y') 
                                        : '' ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted">Không có ca bệnh liên quan nào trong khoảng thời gian này.</p>
            <?php endif; ?>
            <?php if (!empty($cabenh_lienquan)): ?>
                <div class="text-center mt-3">
                                <?= Html::a(
                                    '<i class="fa fa-plus-circle"></i> Tiến hành tạo ổ dịch',
                                    ['odich/tao-odich-tcm', 'id' => $model->id],
                                    [
                                        'class' => 'btn btn-danger btn-lg px-4',
                                        'data-confirm' => 'Bạn có chắc chắn muốn tạo ổ dịch TCM từ các ca bệnh này?',
                                    ]
                                ) ?>
                </div>
            <?php endif; ?>
        </div>
    </div>

</div>

<style>
.container { max-width: 800px; margin: 0 auto; }
.card { border-radius: 10px; box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
.card-header { font-size: 16px; }
.list-group-item { font-size: 15px; }

.btn-danger {
    border-radius: 8px;
    font-weight: 600;
    box-shadow: 0 2px 5px rgba(0,0,0,0.15);
}
.btn-danger:hover {
    background-color: #b52b27;
}
</style>