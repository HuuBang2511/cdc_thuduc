<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\daterange\DateRangePicker;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $totalCases int */
/* @var $newCases24h int */
/* @var $hospitalizedCases int */
/* @var $phuongWithCases int */
/* @var $caseTrendData array */
/* @var $caseByPhuongData array */
/* @var $caseByClusterData array */
/* @var $caseByGenderData array */
/* @var $caseByAgeData array */
/* @var $diseaseList array */
/* @var $phuongxaList array */
/* @var $gioitinhList array */
/* @var $filter array */

$this->title = 'Dashboard Giám sát Dịch tễ';
$this->params['breadcrumbs'][] = $this->title;

// Nạp Chart.js và Font Awesome
$this->registerJsFile('https://cdn.jsdelivr.net/npm/chart.js', ['position' => \yii\web\View::POS_HEAD]);
$this->registerCssFile('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css');

// CSS TÙY CHỈNH CHO GIAO DIỆN CHUYÊN NGHIỆP (V3)
$this->registerCss("
    /* --- Font & Nền --- */
    @import url('https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap');
    
    .dashboard-index {
        font-family: 'Nunito', sans-serif;
        background-color: #f8f9fe; /* Nền xám rất nhạt */
    }

    /* --- Thẻ Lọc (Filter Card) --- */
    .card-filter {
        background-color: #ffffff;
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        margin-bottom: 2rem;
    }
    .card-filter .card-header {
        background-color: transparent;
        border-bottom: 1px solid #f0f0f0;
        padding: 1.25rem 1.5rem;
        font-weight: 700;
        color: #333;
    }
    .card-filter .card-body {
        padding: 1.5rem;
    }
    .form-inline .form-group { margin-bottom: 10px; margin-right: 1.5rem; }
    .form-inline .select2-container .select2-selection--single { border-radius: 0.35rem; height: 38px; border: 1px solid #d1d3e2; }
    .form-inline .select2-container--default .select2-selection--single .select2-selection__rendered { line-height: 36px; }
    .form-inline .select2-container--default .select2-selection--single .select2-selection__arrow { height: 36px; }
    .form-inline .form-control { border-radius: 0.35rem; border: 1px solid #d1d3e2; }
    .btn-primary { background-color: #4e73df; border: none; border-radius: 0.35rem; }
    .btn-outline-secondary { border-radius: 0.35rem; }

    /* --- Thẻ KPI (KPI Cards) --- */
    .kpi-card {
        background-color: #ffffff;
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .kpi-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 16px rgba(0,0,0,0.08);
    }
    .kpi-card .card-body {
        padding: 1.5rem;
        position: relative;
        z-index: 2;
    }
    .kpi-card .kpi-label {
        font-size: 0.9rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #858796; /* Xám mờ */
        margin-bottom: 0.25rem;
    }
    .kpi-card .kpi-value {
        font-size: 2.25rem;
        font-weight: 700;
        line-height: 1.2;
        color: #3a3b45; /* Đen đậm */
    }
    /* Icon trang trí ở góc */
    .kpi-card .kpi-icon {
        position: absolute;
        right: 1.25rem;
        top: 50%;
        transform: translateY(-50%);
        font-size: 3.5rem;
        color: rgba(0,0,0,0.05); /* Rất mờ */
        transition: all 0.3s;
    }
    .kpi-card:hover .kpi-icon {
        color: rgba(0,0,0,0.08);
        transform: translateY(-50%) scale(1.1);
    }
    /* Thêm viền màu tinh tế ở dưới */
    .kpi-card { border-bottom: 4px solid; }
    .kpi-card.border-primary { border-color: #4e73df; }
    .kpi-card.border-warning { border-color: #f6c23e; }
    .kpi-card.border-danger { border-color: #e74a3b; }
    .kpi-card.border-info { border-color: #36b9cc; }
    .kpi-card.border-primary .kpi-value { color: #4e73df; }
    .kpi-card.border-warning .kpi-value { color: #f6c23e; }
    .kpi-card.border-danger .kpi-value { color: #e74a3b; }
    .kpi-card.border-info .kpi-value { color: #36b9cc; }

    /* --- Thẻ Biểu đồ (Chart Cards) --- */
    .chart-card {
        background-color: #ffffff;
        border: none;
        border-radius: 0.5rem;
        box-shadow: 0 4px 12px rgba(0,0,0,0.04);
        margin-bottom: 2rem;
    }
    .chart-card .card-header {
        background-color: #ffffff;
        border-bottom: 1px solid #f0f0f0;
        padding: 1rem 1.5rem;
        font-weight: 700;
    }
    .chart-card .card-body {
        padding: 1.5rem;
    }
    
    /* Tô màu tiêu đề biểu đồ */
    .chart-card .card-header.text-primary { color: #4e73df !important; }
    .chart-card .card-header.text-success { color: #1cc88a !important; }
    .chart-card .card-header.text-info { color: #36b9cc !important; }
    .chart-card .card-header.text-dark { color: #5a5c69 !important; }
");
?>
<div class="dashboard-index" style="padding: 20px;">

    <!-- HÀNG 1: BỘ LỌC -->
    <div class="card card-filter">
        <div class="card-header">
            <i class="fas fa-filter mr-1"></i> BỘ LỌC DỮ LIỆU
        </div>
        <div class="card-body">
            <?php $form = ActiveForm::begin([
                'action' => ['index'],
                'method' => 'get',
                'options' => ['class' => 'form-inline d-flex justify-content-start flex-wrap']
            ]); ?>

            <div class="form-group drp-container">
                <label class="mr-2">Thời gian:</label>
                <?php
                echo DateRangePicker::widget([
                    'name' => 'date_range',
                    'value' => $filter['date_start'] . ' - ' . $filter['date_end'],
                    'convertFormat' => true,
                    'pluginOptions' => [
                        'locale' => ['format' => 'Y-m-d'],
                        'opens' => 'left'
                    ],
                    'options' => ['class' => 'form-control']
                ]);
                echo Html::hiddenInput('date_start', $filter['date_start'], ['id' => 'date_start']);
                echo Html::hiddenInput('date_end', $filter['date_end'], ['id' => 'date_end']);
                ?>
            </div>
            
            <div class="form-group">
                <label class="mr-2">Loại bệnh:</label>
                <?= Select2::widget([
                    'name' => 'disease_id',
                    'value' => $filter['disease_id'],
                    'data' => $diseaseList,
                    'options' => ['placeholder' => 'Tất cả loại bệnh'],
                    'pluginOptions' => ['allowClear' => true],
                ]); ?>
            </div>

            <div class="form-group">
                <label class="mr-2">Phường/Xã:</label>
                <?= Select2::widget([
                    'name' => 'phuongxa_ma_dvhc',
                    'value' => $filter['phuongxa_ma_dvhc'],
                    'data' => $phuongxaList,
                    'options' => ['placeholder' => 'Tất cả Phường/Xã'],
                    'pluginOptions' => ['allowClear' => true],
                ]); ?>
            </div>
            
            <div class="form-group">
                <label class="mr-2">Giới tính:</label>
                <?= Select2::widget([
                    'name' => 'gioitinh_id',
                    'value' => $filter['gioitinh_id'],
                    'data' => $gioitinhList,
                    'options' => ['placeholder' => 'Tất cả giới tính'],
                    'pluginOptions' => ['allowClear' => true],
                ]); ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('<i class="fas fa-check"></i> Áp dụng', ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="fas fa-undo"></i> Xóa lọc', ['index'], ['class' => 'btn btn-outline-secondary ml-2']) ?>
            </div>
            
            <?php ActiveForm::end(); ?>
        </div>
    </div>

    <!-- HÀNG 2: CÁC THẺ KPI -->
    <div class="row">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card kpi-card border-primary h-100">
                <div class="card-body">
                    <p class="kpi-label">Tổng ca mắc (trong kỳ)</p>
                    <p class="kpi-value"><?= Html::encode($totalCases) ?></p>
                    <i class="fas fa-users kpi-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card kpi-card border-warning h-100">
                <div class="card-body">
                    <p class="kpi-label">Ca mắc mới (24h qua)</p>
                    <p class="kpi-value"><?= Html::encode($newCases24h) ?></p>
                    <i class="fas fa-clock kpi-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card kpi-card border-danger h-100">
                <div class="card-body">
                    <p class="kpi-label">Số ca nhập viện</p>
                    <p class="kpi-value"><?= Html::encode($hospitalizedCases) ?></p>
                    <i class="fas fa-hospital kpi-icon"></i>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card kpi-card border-info h-100">
                <div class="card-body">
                    <p class="kpi-label">Số Phường/Xã có ca</p>
                    <p class="kpi-value"><?= Html::encode($phuongWithCases) ?></p>
                    <i class="fas fa-map-marker-alt kpi-icon"></i>
                </div>
            </div>
        </div>
    </div>

    <!-- HÀNG 3: BIỂU ĐỒ CHÍNH -->
    <div class="row">
        <div class="col-lg-7">
            <div class="card chart-card">
                <div class="card-header text-primary">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-chart-line mr-1"></i> Diễn biến ca mắc theo ngày</h6>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="caseTrendChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card chart-card">
                <div class="card-header text-success">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-school mr-1"></i> Phân bố (Cộng đồng vs. Trường học)</h6>
                </div>
                <div class="card-body">
                    <div style="height: 300px;">
                        <canvas id="caseByClusterChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- HÀNG 4: BIỂU ĐỒ DỊCH TỄ HỌC -->
    <div class="row">
        <div class="col-lg-5">
            <div class="card chart-card">
                <div class="card-header text-info">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-map-marked-alt mr-1"></i> Top 10 Phường/Xã (Số ca)</h6>
                </div>
                <div class="card-body">
                    <div style="height: 320px;">
                        <canvas id="caseByPhuongChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-3">
            <div class="card chart-card">
                <div class="card-header text-info">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-venus-mars mr-1"></i> Phân bố Giới tính</h6>
                </div>
                <div class="card-body">
                    <div style="height: 320px;">
                        <canvas id="caseByGenderChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card chart-card">
                <div class="card-header text-info">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-child mr-1"></i> Phân bố Nhóm tuổi</h6>
                </div>
                <div class="card-body">
                    <div style="height: 320px;">
                        <canvas id="caseByAgeChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- HÀNG 5: BẢN ĐỒ GIS -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card chart-card">
                <div class="card-header text-dark">
                    <h6 class="m-0 font-weight-bold"><i class="fas fa-globe-americas mr-1"></i> Bản đồ dịch tễ (GIS)</h6>
                </div>
                <div class="card-body" style="min-height: 450px; display: flex; align-items: center; justify-content: center; background: #f8f9fa; border-radius: 0 0 0.5rem 0.5rem;">
                    <p class="text-muted text-center">
                        (Khu vực tích hợp bản đồ GIS - Leaflet.js) <br/>
                        <i>Đây là nơi bạn sẽ nhúng bản đồ GIS để trực quan hóa các ca bệnh/ổ dịch theo tọa độ (theo Giai đoạn 2 của Đề án).</i>
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
$genderData = json_encode($caseByGenderData['data']);
$genderLabels = json_encode($caseByGenderData['labels']);
$ageData = json_encode($caseByAgeData['data']);
$ageLabels = json_encode($caseByAgeData['labels']);

// Khởi tạo các biểu đồ
$script = <<< JS

// Cấu hình chung cho Chart.js
Chart.defaults.responsive = true;
Chart.defaults.maintainAspectRatio = false;
Chart.defaults.font.family = "'Nunito', 'Helvetica', 'Arial', sans-serif";
Chart.defaults.plugins.tooltip.backgroundColor = '#ffffff';
Chart.defaults.plugins.tooltip.titleColor = '#5a5c69';
Chart.defaults.plugins.tooltip.bodyColor = '#858796';
Chart.defaults.plugins.tooltip.borderColor = '#dddfeb';
Chart.defaults.plugins.tooltip.borderWidth = 1;
Chart.defaults.plugins.tooltip.displayColors = false;
Chart.defaults.plugins.tooltip.padding = 10;
Chart.defaults.plugins.tooltip.cornerRadius = 0.35;


// 1. Biểu đồ đường: Diễn biến ca mắc
if (document.getElementById('caseTrendChart')) {
    var ctxTrend = document.getElementById('caseTrendChart').getContext('2d');
    new Chart(ctxTrend, {
        type: 'line',
        data: {
            labels: $trendLabels,
            datasets: [{
                label: 'Số ca mắc',
                data: $trendData,
                borderColor: '#4e73df',
                backgroundColor: 'rgba(78, 115, 223, 0.05)',
                fill: true,
                tension: 0.3,
                pointBackgroundColor: '#4e73df',
                pointRadius: 3,
                pointHoverRadius: 5
            }]
        },
        options: {
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Số ca' }, grid: { color: '#e3e6f0' } },
                x: { title: { display: true, text: 'Ngày khởi phát' }, grid: { display: false } }
            },
            plugins: { legend: { display: false } }
        }
    });
}

// 2. Biểu đồ tròn: Phân bố (Cộng đồng vs Trường học)
if (document.getElementById('caseByClusterChart')) {
    var ctxCluster = document.getElementById('caseByClusterChart').getContext('2d');
    new Chart(ctxCluster, {
        type: 'doughnut',
        data: {
            labels: $clusterLabels,
            datasets: [{
                data: $clusterData,
                backgroundColor: ['#1cc88a', '#f6c23e', '#e74a3b'],
                hoverBackgroundColor: ['#17a673', '#e0ac28', '#c0392b'],
                borderWidth: 0,
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom', labels: { usePointStyle: true } } },
            cutout: '75%'
        }
    });
}

// 3. Biểu đồ cột ngang: Phân bố theo Phường
if (document.getElementById('caseByPhuongChart')) {
    var ctxPhuong = document.getElementById('caseByPhuongChart').getContext('2d');
    new Chart(ctxPhuong, {
        type: 'bar',
        data: {
            labels: $phuongLabels,
            datasets: [{
                label: 'Số ca mắc',
                data: $phuongData,
                backgroundColor: '#36b9cc',
                borderRadius: 4
            }]
        },
        options: {
            indexAxis: 'y',
            plugins: { legend: { display: false } },
            scales: {
                x: { beginAtZero: true, title: { display: true, text: 'Số ca' }, grid: { color: '#e3e6f0' } },
                y: { grid: { display: false } }
            }
        }
    });
}

// 4. Biểu đồ tròn: Phân bố theo Giới tính
if (document.getElementById('caseByGenderChart')) {
    var ctxGender = document.getElementById('caseByGenderChart').getContext('2d');
    new Chart(ctxGender, {
        type: 'pie',
        data: {
            labels: $genderLabels,
            datasets: [{
                data: $genderData,
                backgroundColor: ['#4e73df', '#e74a3b', '#6c757d'],
                hoverBackgroundColor: ['#2e59d9', '#c0392b', '#5a6268'],
                borderWidth: 0,
            }]
        },
        options: {
            plugins: { legend: { position: 'bottom', labels: { usePointStyle: true } } }
        }
    });
}

// 5. Biểu đồ cột: Phân bố theo Nhóm tuổi
if (document.getElementById('caseByAgeChart')) {
    var ctxAge = document.getElementById('caseByAgeChart').getContext('2d');
    new Chart(ctxAge, {
        type: 'bar',
        data: {
            labels: $ageLabels,
            datasets: [{
                label: 'Số ca mắc',
                data: $ageData,
                backgroundColor: '#fd7e14',
                borderRadius: 4
            }]
        },
        options: {
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, title: { display: true, text: 'Số ca' }, grid: { color: '#e3e6f0' } },
                x: { grid: { display: false } }
            }
        }
    });
}

// Cập nhật input ẩn khi DateRangePicker thay đổi
$('input[name="date_range"]').on('apply.daterangepicker', function(ev, picker) {
    $('#date_start').val(picker.startDate.format('YYYY-MM-DD'));
    $('#date_end').val(picker.endDate.format('YYYY-MM-DD'));
});

JS;
$this->registerJs($script, \yii\web\View::POS_READY);
?>

