
<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

?>
<!DOCTYPE html>
<html lang="vi">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      background-color: #f1f3f8;
      min-height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .main{
        width:100%;
        height: 50vh;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .report-box {
      background: #fff;
      border-radius: 16px;
      box-shadow: 0 6px 20px rgba(0,0,0,0.15);
      padding: 40px 50px;
      max-width: 500px;
      width: 90%;
      text-align: center;
    }
    .report-box h3 {
      color: #d32f2f;
      margin-bottom: 15px;
      font-weight: 700;
    }
    .report-box p {
      color: #555;
      font-size: 16px;
    }
    .btn-back {
      background-color: #0d6efd;
      color: #fff;
      font-weight: 500;
      border-radius: 8px;
      padding: 10px 20px;
      transition: all 0.3s ease;
    }
    .btn-back:hover {
      background-color: #0b5ed7;
      transform: translateY(-2px);
    }
  </style>
</head>
<body>
    <div class="main">
        <div class="report-box">
            
            <p>Cập nhật thông tin ngày mặc bệnh, và thông tin trường học nếu là ca bệnh trường học, nếu là ca bệnh cộng đồng, cập nhật thông tin nơi ở hiện tại</p>
            
            <?= Html::a('Cập nhật', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
  
</body>
</html>
