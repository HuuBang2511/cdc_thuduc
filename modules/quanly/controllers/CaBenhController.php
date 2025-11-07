<?php

namespace app\modules\quanly\controllers;

use Yii;
use app\modules\quanly\models\CaBenh;
use app\modules\quanly\models\CaBenhSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use app\modules\quanly\base\QuanlyBaseController;
use app\modules\services\CategoriesService;
use DateTime;
use app\modules\quanly\models\ImportUpload;
use yii\web\UploadedFile;
use app\modules\quanly\models\PhuongXa;
use app\modules\quanly\models\danhmuc\DmGioitinh;
use app\modules\quanly\models\BenhVien;
use app\modules\quanly\models\Khupho;
use app\modules\quanly\models\Truonghoc;
use app\modules\quanly\models\danhmuc\DmLoaicabenh;
use app\modules\quanly\models\danhmuc\DmLoaiodich;
use PhpOffice\PhpSpreadsheet\Cell\Coordinate;
use PhpOffice\PhpSpreadsheet\IOFactory;

/**
 * CaBenhController implements the CRUD actions for CaBenh model.
 */
class CaBenhController extends QuanlyBaseController
{

    public $title = "Ca bệnh";

    public $label = [
        'index' => 'Danh sách',
        'create' => 'Thêm mới',
        'update' => 'Cập nhật',
        'view' => 'Chi tiết',
        'delete' => 'Xóa',
    ];

    /**
     * Lists all CaBenh models.
     * @return mixed
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;
        $queryParams = $request->queryParams;
        $searchModel = new CaBenhSearch();

        //dd($searchModel);
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        // if ($request->isPost && $searchModel->load($request->post())) {
        //      $url = ['index'];
        //     foreach ($request->post()['CaBenhSearch'] as $i => $item) {
        //         $url = array_merge($url,["CaBenhSearch[$i]" => $item]);
        //     }
        //     return $this->redirect($url);
        // }

        // if (isset($request->post()['CaBenhSearch'])) {
        //     foreach ($request->post()['CaBenhSearch'] as $i => $item) {
        //         $url = array_merge($url, ["CaBenhSearch[$i]" => $item]);
        //     }
        // }

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => CategoriesService::getCategoriesCabenh(),
        ]);
    }


    /**
     * Displays a single CaBenh model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        //dd($model->phuongxachinh);

        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new CaBenh model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new CaBenh();

        if($model->load($request->post())){
            
            if($model->ngaybaocao != null){
                $date = new DateTime($model->ngaybaocao); 
                $date->modify('+7 days'); 
                $model->ngayhandieutra = $date->format('d/m/Y'); 
                //dd($model->ngayhandieutra);
            }

            if($model->is_dieutra == 1){
                $model->tinhtrang_dieutra = 'ĐÃ ĐIỀU TRA';

                if($model->ngay_dieutra_dichte != null){
                    if($model->ngay_dieutra_dichte <= $model->ngayhandieutra){
                        $model->tiendo_dieutra = 'ĐÚNG HẠN';
                    }else{
                        $model->tiendo_dieutra = 'QUÁ HẠN';
                    }
                }

            }else{
                $model->tinhtrang_dieutra = 'CHƯA ĐIỀU TRA';
            }

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => CategoriesService::getCategoriesCabenh(),
        ]);
    }

    /**
     * Updates an existing CaBenh model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if($model->load($request->post())){

            if($model->ngaybaocao != null){
                $date = new DateTime($model->ngaybaocao); 
                $date->modify('+7 days'); 
                $model->ngayhandieutra = $date->format('d/m/Y'); 
                //dd($model->ngayhandieutra);
            }

            if($model->is_dieutra == 1){
                $model->tinhtrang_dieutra = 'ĐÃ ĐIỀU TRA';

                if($model->ngay_dieutra_dichte != null){
                    if($model->ngay_dieutra_dichte <= $model->ngayhandieutra){
                        $model->tiendo_dieutra = 'ĐÚNG HẠN';
                    }else{
                        $model->tiendo_dieutra = 'QUÁ HẠN';
                    }
                }

            }else{
                $model->tinhtrang_dieutra = 'CHƯA ĐIỀU TRA';
            }

            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => CategoriesService::getCategoriesCabenh(),
        ]);
    }

    public function actionImportTcmCongdong(){
        $request = Yii::$app->request;
        $fileUpload = new ImportUpload();
        $errorRow = null;
        $notification = null;

        $categories['truonghoc'] = Truonghoc::find()->select(['gid', 'ten_dv'])->indexBy('ten_dv')->asArray()->all();
        $categories['benhvien'] = BenhVien::find()->select(['id', 'tenbenhvien'])->indexBy('tenbenhvien')->asArray()->all();
        $categories['phuong'] = Phuongxa::find()->select(['ma_dvhc', 'ten_dvhc', 'ma_dvhc', 'id'])->where(['status'=>1])->indexBy('ten_dvhc')->asArray()->all();
        $categories['dm_loaiodich'] = DmLoaiodich::find()->where(['status'=>1])->indexBy('ten')->asArray()->all();
        $categories['dm_gioitinh'] = DmGioitinh::find()->where(['status'=>1])->indexBy('ten')->asArray()->all();
        $categories['dm_loaicabenh'] = DmLoaicabenh::find()->where(['status'=>1])->indexBy('ten')->asArray()->all();

        $cb = new CaBenh();
        $attributes = $cb->attributeLabels();
        
        if($request->isPost){
            $highestRow = 0;
            $newRecords = 0;
            $notification = null;
            $notification = [];
            $fileUpload->file = UploadedFile::getInstance($fileUpload, 'file');

            if($fileUpload->uploadFile()){
                $spreadsheet = IOFactory::load($fileUpload->link);
                $worksheet = $spreadsheet->getSheet(0);

                $transaction = Yii::$app->db->beginTransaction();
                try {

                    if($worksheet->getHighestRow() < 2){
                        Yii::$app->session->setFlash('noData', "Không có dữ liệu!");
                        return $this->render('import-tcm-congdong', [
                            'fileUpload' => $fileUpload,
                            'notification' => $notification,
                        ]);
                    }
                    else{
                        $highestRow = $worksheet->getHighestRow();
                        $highestColumn = $worksheet->getHighestColumn();
                        $highestColumnIndex = Coordinate::columnIndexFromString($highestColumn);

                        $themmoi = 0;
                        $capnhap = 0;

                        for($row = 2; $row <= $highestRow; $row++){
                            for($col = 2; $col <= 22; $col++){
                                $dataCabenh[$row]['CaBenh'][array_search($worksheet->getCellByColumnAndRow($col, 1)->getValue(),$attributes)] = 
                                $worksheet->getCellByColumnAndRow($col, $row)->getValue();
                            }

                            $dataInput = $dataCabenh[$row]["CaBenh"];

                            //dd($dataInput);

                            if($dataInput['mabenhnhan'] === null)
                            {
                                $notification[$row]['style'] = 'text-danger';
                                $notification[$row]['data'] = 'Thiếu thông tin mã bệnh nhân dòng: '. $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                continue;
                            }

                            if($dataInput['phuongxa_noiohientai'] != null){
                                if(!(array_key_exists($dataInput['phuongxa_noiohientai'],$categories['phuong']))){
                                    $notification[$row]['style'] = 'text-danger';
                                    $notification[$row]['data'] = 'Sai tên phường xã nơi ở hiện tại  dòng: '. $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                    continue;
                                }   
                                else{
                                    $dataCabenh[$row]["CaBenh"]['phuongxa_noiohientai'] = $categories['phuong'][$dataInput['phuongxa_noiohientai']]['ma_dvhc'];

                                    if($dataInput['khupho_noiohientai_id'] != null){
                                        
                                        $kp_noioht = Khupho::find()->select(['id', 'ten_dvhc'])
                                        ->where(['phuongxa_id' => $categories['phuong'][$dataInput['phuongxa_noiohientai']]['id']])->indexBy('ten_dvhc')->asArray()->all();
                                        //dd($kp_noioht);
                                        if(!(array_key_exists($dataInput['khupho_noiohientai_id'],$kp_noioht))){
                                            $notification[$row]['style'] = 'text-danger';
                                            $notification[$row]['data'] = 'Sai tên khu phố nơi ở hiện tại  dòng: '. $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                            continue;
                                        }else{
                                            $dataCabenh[$row]["CaBenh"]['khupho_noiohientai_id'] = $kp_noioht[$dataInput['khupho_noiohientai_id']]['id'];
                                        }
                                    }
                                }
                            }

                            if($dataInput['truonghoc_phuongxa'] != null){
                                if(!(array_key_exists($dataInput['truonghoc_phuongxa'],$categories['phuong']))){
                                    $notification[$row]['style'] = 'text-danger';
                                    $notification[$row]['data'] = 'Sai tên phường xã trường học dòng: '. $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                    continue;
                                }   
                                else{
                                    $dataCabenh[$row]["CaBenh"]['truonghoc_phuongxa'] = $categories['phuong'][$dataInput['truonghoc_phuongxa']]['ma_dvhc'];

                                    if($dataInput['truonghoc_khupho_id'] != null){
                                        
                                        $kp_truong = Khupho::find()->select(['id', 'ten_dvhc'])
                                        ->where(['phuongxa_id' => $categories['phuong'][$dataInput['truonghoc_phuongxa']]['id']])->indexBy('ten_dvhc')->asArray()->all();
                                        if(!(array_key_exists($dataInput['truonghoc_khupho_id'],$kp_truong))){
                                            $notification[$row]['style'] = 'text-danger';
                                            $notification[$row]['data'] = 'Sai tên khu phố trường học dòng: '. $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                            continue;
                                        }else{
                                            $dataCabenh[$row]["CaBenh"]['truonghoc_khupho_id'] = $kp_truong[$dataInput['truonghoc_khupho_id']]['id'];
                                        }
                                    }
                                }
                            }

                            if($dataInput['loaicabenh_id'] != null){
                                if(!(array_key_exists(trim($dataInput['loaicabenh_id']),$categories['dm_loaicabenh']))){
                                    $notification[$row]['style'] = 'text-danger';
                                    $notification[$row]['data'] = 'Sai tên loại ca bênh dòng: '. $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                    continue;
                                }else{
                                    $dataCabenh[$row]["CaBenh"]['loaicabenh_id'] = $categories['dm_loaicabenh'][$dataInput['loaicabenh_id']]['id'];
                                } 
                            }

                            if($dataInput['truonghoc_id'] != null){
                                if(!(array_key_exists(trim($dataInput['truonghoc_id']),$categories['truonghoc']))){
                                    $notification[$row]['style'] = 'text-danger';
                                    $notification[$row]['data'] = 'Sai tên trường học dòng: '. $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                    continue;
                                }else{
                                    $dataCabenh[$row]["CaBenh"]['truonghoc_id'] = $categories['truonghoc'][$dataInput['truonghoc_id']]['gid'];
                                } 
                            }
                            
                            if($dataInput['gioitinh_id'] != null){
                                if(!(array_key_exists(trim($dataInput['gioitinh_id']),$categories['dm_gioitinh']))){
                                    $notification[$row]['style'] = 'text-danger';
                                    $notification[$row]['data'] = 'Sai tên giới tính dòng: '. $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                                    continue;
                                }else{
                                    $dataCabenh[$row]["CaBenh"]['gioitinh_id'] = $categories['dm_gioitinh'][$dataInput['gioitinh_id']]['id'];
                                } 
                            }

                            if($dataCabenh[$row]["CaBenh"]['so_nha'] != null){
                                $dataCabenh[$row]["CaBenh"]['so_nha'] = trim((string)$dataCabenh[$row]["CaBenh"]['so_nha']);
                            }

                            if($dataCabenh[$row]["CaBenh"]['ten_duong'] != null){
                                $dataCabenh[$row]["CaBenh"]['ten_duong'] = trim((string)$dataCabenh[$row]["CaBenh"]['ten_duong']);
                            }

                            if($dataCabenh[$row]["CaBenh"]['madinhdanh'] != null){
                                $dataCabenh[$row]["CaBenh"]['madinhdanh'] = trim((string)$dataCabenh[$row]["CaBenh"]['madinhdanh']);
                            }

                            //dd($dataCabenh[$row]);

                            $cabenh = new CaBenh(['loaibenh_id' => 2, 'is_dieutra' => 0]);
                            $cabenh->load($dataCabenh[$row]);
                            $cabenh->save();
                            $themmoi += 1;
                        }
                    }

                    $transaction->commit();
                    Yii::$app->session->setFlash('uploadSuccess', "Đã thêm mới thành công ".$themmoi." dòng dữ liệu.");
                }
                catch (Exception $e){
                    $transaction->rollBack();
                    Yii::$app->session->setFlash('uploadFail', "Lỗi dòng $errorRow!");
                    return $this->render('import-tcm-congdong',[
                        'fileUpload' => $fileUpload,
                        'errorRow' => $errorRow,
                        'notification' => $notification,
                    ]);
                }
            }
        }

        return $this->render('import-tcm-congdong', [
            'check' => null,
            'fileUpload' => $fileUpload,
            'notification' => $notification,
        ]);
    }

    /**
     * Delete an existing CaBenh model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);
        $model->status = 0;

        if ($request->isAjax) {
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isGet) {
                return [
                    'title' => "Xóa ca bệnh #" . $id,
                    'content' => $this->renderAjax('delete', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Đóng', ['class' => 'btn btn-light float-right', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Xóa', ['class' => 'btn btn-danger float-left', 'type' => "submit"])
                ];
            } else if ($request->isPost && $model->save()) {
                return [
                    'forceReload' => '#crud-datatable-pjax',
                    'title' => "Xóa ca bệnh thành công #" . $id,
                    'content' => '<span class="text-success">Xóa thành công</span>',
                    'footer' => Html::button('Close', ['class' => 'btn btn-light float-right', 'data-bs-dismiss' => "modal"])
                ];
            } else {
                return [
                    'title' => "Update #" . $id,
                    'content' => $this->renderAjax('delete', [
                        'model' => $model,
                    ]),
                    'footer' => Html::button('Close', ['class' => 'btn btn-light float-right', 'data-bs-dismiss' => "modal"]) .
                        Html::button('Save', ['class' => 'btn btn-primary', 'type' => "submit"])
                ];
            }
        }
    }

    
    /**
     * Finds the CaBenh model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return CaBenh the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = CaBenh::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
