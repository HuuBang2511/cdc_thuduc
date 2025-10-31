<?php

namespace app\modules\quanly\controllers;

use app\modules\quanly\base\QuanlyBaseController;
use app\modules\quanly\models\CaBenh;
use app\modules\quanly\models\Phuongxa;
use app\modules\quanly\models\danhmuc\DmLoaichandoan;
use app\modules\quanly\models\danhmuc\DmGioitinh;
use Yii;
use yii\db\Expression;
use yii\helpers\ArrayHelper;

class DashboardController extends QuanlyBaseController
{
    public function actionIndex()
    {
        // --- 1. LẤY THAM SỐ LỌC ---
        $params = Yii::$app->request->get();
        
        // Giá trị mặc định cho bộ lọc
        $defaultDateStart = date('Y-m-d', strtotime('-30 days'));
        $defaultDateEnd = date('Y-m-d');
        
        $dateStart = $params['date_start'] ?? $defaultDateStart;
        $dateEnd = $params['date_end'] ?? $defaultDateEnd;
        $diseaseId = $params['disease_id'] ?? null;
        $phuongxaMaDvhc = $params['phuongxa_ma_dvhc'] ?? null;
        $gioitinhId = $params['gioitinh_id'] ?? null;

        // --- 2. TẠO QUERY CƠ SỞ (BASE QUERY) ---
        $query = CaBenh::find()
            ->where(['between', 'DATE(ngaykhoiphat)', $dateStart, $dateEnd]);

        // Áp dụng các bộ lọc nếu có
        $query->andFilterWhere(['loaibenh_id' => $diseaseId]);
        $query->andFilterWhere(['phuongxa_noiohientai' => $phuongxaMaDvhc]); // 'phuongxa_noiohientai' là ma_dvhc
        $query->andFilterWhere(['gioitinh_id' => $gioitinhId]);

        // --- 3. LẤY DỮ LIỆU CHO CÁC THẺ KPI ---
        
        $totalCases = (clone $query)->count();
        $newCases24h = (clone $query)
            ->andWhere(['>=', 'ngaybaocao', new Expression('NOW() - INTERVAL \'24 hours\'')])
            ->count();
        
        // Đề án có 'conhapvien'
        $hospitalizedCases = (clone $query)
            ->andWhere(['conhapvien' => true])
            ->count();

        // Đếm số phường xã (ma_dvhc) riêng biệt có ca
        $phuongWithCases = (clone $query)
            ->select(['phuongxa_noiohientai'])
            ->distinct()
            ->count();

        // --- 4. LẤY DỮ LIỆU CHO CÁC BIỂU ĐỒ ---

        // A. Biểu đồ đường: Diễn biến ca mắc theo ngày
        $caseTrendQuery = (clone $query)
            ->select([
                'date' => new Expression('DATE(ngaykhoiphat)'),
                'count' => 'COUNT(id)'
            ])
            ->groupBy(new Expression('DATE(ngaykhoiphat)'))
            ->orderBy(['date' => SORT_ASC])
            ->asArray()
            ->all();
        $caseTrendData = [
            'labels' => array_column($caseTrendQuery, 'date'),
            'data' => array_column($caseTrendQuery, 'count'),
        ];

        // B. Biểu đồ cột: Phân bố ca mắc theo Phường/Xã
        $caseByPhuongQuery = (clone $query)
            ->joinWith('phuongxaNoiohientai') // Quan hệ trong CaBenh: getPhuongxaNoiohientai()
            ->select([
                'phuong' => 'phuongxa.ten_dvhc',
                'count' => 'COUNT(ca_benh.id)'
            ])
            ->groupBy('phuongxa.ten_dvhc')
            ->orderBy(['count' => SORT_DESC])
            ->limit(10)
            ->asArray()
            ->all();
        $caseByPhuongData = [
            'labels' => array_column($caseByPhuongQuery, 'phuong'),
            'data' => array_column($caseByPhuongQuery, 'count'),
        ];

        // C. Biểu đồ tròn: Phân bố (Cộng đồng vs Trường học)
        $caseByClusterQuery = (clone $query)
            ->select([
                'cluster' => new Expression("CASE WHEN truonghoc_id IS NOT NULL THEN 'Trường học' ELSE 'Cộng đồng' END"),
                'count' => 'COUNT(id)'
            ])
            ->groupBy('cluster')
            ->asArray()
            ->all();
        $caseByClusterData = [
            'labels' => array_column($caseByClusterQuery, 'cluster'),
            'data' => array_column($caseByClusterQuery, 'count'),
        ];

        // D. Biểu đồ tròn: Phân bố theo Giới tính
        $caseByGenderQuery = (clone $query)
            ->joinWith('gioitinh') // Quan hệ trong CaBenh: getGioitinh()
            ->select([
                'gender' => 'dm_gioitinh.ten',
                'count' => 'COUNT(ca_benh.id)'
            ])
            ->groupBy('dm_gioitinh.ten')
            ->asArray()
            ->all();
        $caseByGenderData = [
            'labels' => array_column($caseByGenderQuery, 'gender'),
            'data' => array_column($caseByGenderQuery, 'count'),
        ];

        // E. Biểu đồ cột: Phân bố theo Nhóm tuổi (Dùng hàm AGE của PostgreSQL)
        $ageExpression = new Expression("DATE_PART('year', AGE(ngaysinh))");
        $ageGroupExpression = new Expression("
            CASE
                WHEN ($ageExpression) < 5 THEN '0-4 tuổi'
                WHEN ($ageExpression) BETWEEN 5 AND 14 THEN '5-14 tuổi'
                WHEN ($ageExpression) BETWEEN 15 AND 59 THEN '15-59 tuổi'
                WHEN ($ageExpression) >= 60 THEN '60+ tuổi'
                ELSE 'Không rõ'
            END
        ");
        $caseByAgeQuery = (clone $query)
            ->select([
                'age_group' => $ageGroupExpression,
                'count' => 'COUNT(id)'
            ])
            ->groupBy($ageGroupExpression)
            ->orderBy(new Expression("MIN(CASE WHEN ($ageExpression) < 5 THEN 1 WHEN ($ageExpression) BETWEEN 5 AND 14 THEN 2 WHEN ($ageExpression) BETWEEN 15 AND 59 THEN 3 WHEN ($ageExpression) >= 60 THEN 4 ELSE 5 END)"))
            ->asArray()
            ->all();
        $caseByAgeData = [
            'labels' => array_column($caseByAgeQuery, 'age_group'),
            'data' => array_column($caseByAgeQuery, 'count'),
        ];


        // --- 5. LẤY DANH SÁCH CHO BỘ LỌC ---
        
        $diseaseList = ArrayHelper::map(
            DmLoaichandoan::find()->where(['status' => 1])->orderBy('ten')->asArray()->all(), 
            'id', 'ten'
        );
        $phuongxaList = ArrayHelper::map(
            Phuongxa::find()->orderBy('ten_dvhc')->asArray()->all(), 
            'ma_dvhc', 'ten_dvhc'
        );
        $gioitinhList = ArrayHelper::map(
            DmGioitinh::find()->where(['status' => 1])->asArray()->all(), 
            'id', 'ten'
        );

        // --- 6. RENDER VIEW ---
        return $this->render('index', [
            // Dữ liệu KPI
            'totalCases' => $totalCases,
            'newCases24h' => $newCases24h,
            'hospitalizedCases' => $hospitalizedCases,
            'phuongWithCases' => $phuongWithCases,
            
            // Dữ liệu Biểu đồ
            'caseTrendData' => $caseTrendData,
            'caseByPhuongData' => $caseByPhuongData,
            'caseByClusterData' => $caseByClusterData,
            'caseByGenderData' => $caseByGenderData,
            'caseByAgeData' => $caseByAgeData,
            
            // Dữ liệu cho Bộ lọc
            'diseaseList' => $diseaseList,
            'phuongxaList' => $phuongxaList,
            'gioitinhList' => $gioitinhList,
            'filter' => [
                'date_start' => $dateStart,
                'date_end' => $dateEnd,
                'disease_id' => $diseaseId,
                'phuongxa_ma_dvhc' => $phuongxaMaDvhc,
                'gioitinh_id' => $gioitinhId,
            ],
        ]);
    }
}

