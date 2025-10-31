<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker; // Giả sử bạn dùng widget này
use kartik\select2\Select2; // Giả sử bạn dùng Select2

/* @var $this yii\web\View */
/* @var $totalCases int */
/* @var $newCases24h int */
/* @var $activeOutbreaks int */
/* @var $caseTrendData array */
/* @var $caseByPhuongData array */
/* @var $caseByClusterData array */
/* @var $diseaseList array */
/* @var $filter array */

$this->title = 'Dashboard Giám sát Dịch tễ';
$this->params['breadcrumbs'][] = $this->title;

// Nạp Chart.js - ĐÃ SỬA LỖI
$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js', ['position' => \yii\web\View::POS_HEAD]);
?>
<div class="dashboard-index">

    <!-- HÀNG 1: BỘ LỌC -->
    <div class="card card-default shadow-sm mb-4">
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => ['class' => 'form-inline']
            ]); ?>

            <div class="form-group mr-3">
                <label class="mr-2">Loại bệnh:</label>
                <?= Html::dropDownList('disease_id', $filter['disease_id'], $diseaseList, [
                    'class' => 'form-control', 
                    'prompt' => 'Tất cả loại bệnh'
                ]) ?>
                
                <?php /*
                // Dùng Select2 nếu bạn đã cài đặt:
                echo Select2::widget([
                    'name' => 'disease_id',
                    'value' => $filter['disease_id'],
                    'data' => $diseaseList,
                    'options' => ['placeholder' => 'Chọn loại bệnh...'],
                    'pluginOptions' => ['allowClear' => true],
                ]);
                */ ?>
            </div>

            <div class="form-group mr-3">
                <label class="mr-2">Thời gian (Ngày khởi phát):</label>
                <?php
                // Dùng DateRangePicker của Kartik nếu có
                echo DateRangePicker::widget([
                    'name' => 'date_range',
                    'value' => $filter['date_start'] . ' - ' . $filter['date_end'],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'locale' => ['format' => 'Y-m-d'],
                        'opens' => 'left'
                    ],
                    'options' => ['class' => 'form-control', 'style' => 'width: 250px;']
                ]);
                // Input ẩn để gửi date_start và date_end
                echo Html::hiddenInput('date_start', $filter['date_start'], ['id' => 'date_start']);
                echo Html::hiddenInput('date_end', $filter['date_end'], ['id' => 'date_end']);
                
                // Ghi đè giá trị input ẩn khi DateRangePicker thay đổi
                $this->registerJs("
                    $('input[name=\"date_range\"]').on('apply.daterangepicker', function(ev, picker) {
                        $('#date_start').val(picker.startDate.format('YYYY-MM-DD'));
                        $('#date_end').val(picker.endDate.format('YYYY-MM-DD'));
                    });
                ");
                ?>
            </div>

            <?= Html::submitButton('Lọc dữ liệu', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Xóa lọc', ['index'], ['class' => 'btn btn-outline-secondary ml-2']) ?>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <!-- HÀNG 2: CÁC THẺ KPI -->
    <div class="row">
        <div class="col-md-4">
            <div class="card text-white bg-primary shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">TỔNG SỐ CA MẮC (TRONG KỲ)</h5>
                    <p class="card-text" style="font-size: 2.5rem; font-weight: bold;">
                        <?= Html::encode($totalCases) ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">CA MẮC MỚI (24 GIỜ QUA)</h5>
                    <p class="card-text" style="font-size: 2.5rem; font-weight: bold;">
                        <?= Html::encode($newCases24h) ?>
                    </p>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-danger shadow-sm mb-3">
                <div class="card-body">
                    <h5 class="card-title">SỐ KHU PHỐ GHI NHẬN CA</h5>
                    <p class="card-text" style="font-size: 2.5rem; font-weight: bold;">
                        <?= Html::encode($activeOutbreaks) ?>
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- HÀNG 3: BIỂU ĐỒ -->
    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Biểu đồ diễn biến ca mắc theo ngày</h6>
                </div>
                <div class="card-body">
                    <canvas id="caseTrendChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Phân bố (Cộng đồng vs. Trường học)</h6>
                </div>
                <div class="card-body">
                    <canvas id="caseByClusterChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- HÀNG 4: BẢN ĐỒ VÀ PHÂN BỐ -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Top 10 Phường/Xã có ca mắc cao nhất</h6>
                </div>
                <div class="card-body">
                    <canvas id="caseByPhuongChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card shadow-sm mb-4">
                <div class="card-header">
                    <h6 class="m-0 font-weight-bold text-primary">Bản đồ dịch tễ (GIS)</h6>
                </div>
                <div class="card-body" style="min-height: 400px; display: flex; align-items: center; justify-content: center; background: #f8f9fa;">
                    <p class="text-muted">
                        (Khu vực tích hợp bản đồ GIS - Leaflet.js) <br/>
                        <i>Đề án của bạn yêu cầu tích hợp bản đồ GIS. Đây là nơi bạn sẽ nhúng bản đồ đó vào để trực quan hóa các ca bệnh/ổ dịch theo tọa độ.</i>
                    </p>
                </div>
            </div>
        </div>
    </div>

</div>

<?php
// Chuyển dữ liệu PHP sang JSON cho JavaScript
$trendData = json_encode($caseTrendData['data']);
$trendLabels = json_encode($caseTrendData['labels']);
$phuongData = json_encode($caseByPhuongData['data']);
$phuongLabels = json_encode($caseByPhuongData['labels']);
$clusterData = json_encode($caseByClusterData['data']);
$clusterLabels = json_encode($caseByClusterData['labels']);

// Khởi tạo các biểu đồ
$script = <<< JS

// 1. Biểu đồ đường: Diễn biến ca mắc
var ctxTrend = document.getElementById('caseTrendChart').getContext('2d');
new Chart(ctxTrend, {
    type: 'line',
    data: {
        labels: $trendLabels,
        datasets: [{
            label: 'Số ca mắc',
            data: $trendData,
            borderColor: 'rgba(75, 192, 192, 1)',
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            fill: true,
            tension: 0.1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true,
                title: { display: true, text: 'Số ca' }
            },
            x: {
                title: { display: true, text: 'Ngày khởi phát' }
            }
        }
    }
});

// 2. Biểu đồ cột: Phân bố theo Phường
var ctxPhuong = document.getElementById('caseByPhuongChart').getContext('2d');
new Chart(ctxPhuong, {
    type: 'bar',
    data: {
        labels: $phuongLabels,
        datasets: [{
            label: 'Số ca mắc',
            data: $phuongData,
            backgroundColor: 'rgba(255, 99, 132, 0.5)',
            borderColor: 'rgba(255, 99, 132, 1)',
            borderWidth: 1
        }]
    },
    options: {
        indexAxis: 'y', // Biểu đồ cột ngang
        responsive: true,
        plugins: {
            legend: {
                display: false
            }
        },
        scales: {
            x: {
                beginAtZero: true,
                title: { display: true, text: 'Số ca' }
            }
        }
    }
});

// 3. Biểu đồ tròn: Phân bố cụm dịch
var ctxCluster = document.getElementById('caseByClusterChart').getContext('2d');
new Chart(ctxCluster, {
    type: 'doughnut',
    data: {
        labels: $clusterLabels,
        datasets: [{
            label: 'Phân bố',
            data: $clusterData,
            backgroundColor: [
                'rgba(54, 162, 235, 0.5)',
                'rgba(255, 206, 86, 0.5)',
            ],
            borderColor: [
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
            ],
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        plugins: {
            legend: {
                position: 'bottom',
            }
        }
    }
});

JS;
$this->registerJs($script);
?>

