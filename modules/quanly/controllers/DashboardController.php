<?php

namespace app\modules\quanly\controllers;

use app\modules\quanly\base\QuanlyBaseController;
use app\modules\quanly\models\CaBenh;
use app\modules\quanly\models\Phuongxa;
use app\modules\quanly\models\danhmuc\DmLoaichandoan; // Dùng cho bộ lọc loại bệnh
use Yii;
use yii\db\Expression;

class DashboardController extends QuanlyBaseController
{
    public function actionIndex()
    {
        // Lấy tham số filter từ request
        $params = Yii::$app->request->get();
        
        $dateStart = $params['date_start'] ?? date('Y-m-d', strtotime('-30 days'));
        $dateEnd = $params['date_end'] ?? date('Y-m-d');
        $diseaseId = $params['disease_id'] ?? null;

        // --- Tạo Query cơ sở (Base Query) ---
        $query = CaBenh::find()
            ->where(['between', 'DATE(ngaykhoiphat)', $dateStart, $dateEnd]);

        if ($diseaseId) {
            $query->andWhere(['loaibenh_id' => $diseaseId]);
        }

        // --- 1. Lấy dữ liệu cho các thẻ KPI ---
        
        // Tổng ca mắc trong kỳ
        $totalCases = (clone $query)->count();

        // Ca mắc mới trong 24h
        $newCases24h = (clone $query)
            ->andWhere(['>=', 'ngaybaocao', new Expression('NOW() - INTERVAL \'24 hours\'')])
            ->count();

        // Ổ dịch đang hoạt động (Logic này cần định nghĩa rõ "ổ dịch" - Tạm để số 0)
        // Đề án của bạn yêu cầu "cảnh báo ổ dịch", chúng ta sẽ thống kê theo khu phố
        $activeOutbreaks = (clone $query)
            ->select(['khupho_noiohientai_id'])
            ->distinct()
            ->count();


        // --- 2. Lấy dữ liệu cho Biểu đồ ---

        // Biểu đồ đường: Diễn biến ca mắc theo ngày
        $caseTrendQuery = (clone $query)
            ->select([
                'date' => new Expression('DATE(ngaykhoiphat)'),
                'count' => 'COUNT(id)'
            ])
            ->groupBy(new Expression('DATE(ngaykhoiphat)'))
            ->orderBy(['date' => SORT_ASC])
            ->asArray()
            ->all();
        
        // Định dạng lại cho Chart.js
        $caseTrendData = [
            'labels' => array_column($caseTrendQuery, 'date'),
            'data' => array_column($caseTrendQuery, 'count'),
        ];


        // Biểu đồ cột: Phân bố ca mắc theo Phường/Xã
        // Lưu ý: Dùng `phuongxa_noiohientai` (string) vì model `CaBenh` có trường này
        // Nếu dùng ID, join sẽ phức tạp hơn: CaBenh -> Khupho -> Phuongxa
        $caseByPhuongQuery = (clone $query)
            ->joinWith('khuphoNoiohientai.phuongxa') // Giả định quan hệ `getKhuphoNoiohientai()` và `getPhuongxa()` trong model
            ->select([
                'phuong' => 'phuongxa.ten_dvhc', // Lấy tên phường từ bảng phuongxa
                'count' => 'COUNT(ca_benh.id)'
            ])
            ->groupBy('phuongxa.ten_dvhc')
            ->orderBy(['count' => SORT_DESC])
            ->limit(10) // Lấy 10 phường cao nhất
            ->asArray()
            ->all();
            
        $caseByPhuongData = [
            'labels' => array_column($caseByPhuongQuery, 'phuong'),
            'data' => array_column($caseByPhuongQuery, 'count'),
        ];

        // Biểu đồ tròn: Phân bố ca (Cộng đồng vs Trường học)
        // Đề án nhấn mạnh việc phân loại này
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

        // --- Lấy danh sách cho bộ lọc ---
        // Lấy 2 bệnh SXH, TCM từ Đề án (Giả sử ID là 1 và 2)
        // Bạn nên thay bằng cách query từ bảng dm_loaichandoan
        $diseaseList = [
            1 => 'Sốt xuất huyết', // Thay ID cho đúng
            2 => 'Tay chân miệng', // Thay ID cho đúng
        ];
        // $diseaseList = DmLoaichandoan::find()->select(['ten_benh', 'id'])->indexBy('id')->column();


        // Render view và truyền dữ liệu
        return $this->render('index', [
            'totalCases' => $totalCases,
            'newCases24h' => $newCases24h,
            'activeOutbreaks' => $activeOutbreaks,
            'caseTrendData' => $caseTrendData,
            'caseByPhuongData' => $caseByPhuongData,
            'caseByClusterData' => $caseByClusterData,
            'diseaseList' => $diseaseList,
            'filter' => [
                'date_start' => $dateStart,
                'date_end' => $dateEnd,
                'disease_id' => $diseaseId,
            ],
        ]);
    }
}
