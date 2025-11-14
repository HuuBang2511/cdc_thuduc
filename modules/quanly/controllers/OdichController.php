<?php

namespace app\modules\quanly\controllers;

use Yii;
use app\modules\quanly\models\Odich;
use app\modules\quanly\models\OdichSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\quanly\base\QuanlyBaseController;
use app\modules\quanly\models\OdichCabenh;
use app\modules\quanly\models\Cabenh;
use DateTime;
use DateTimeZone;
use yii\helpers\ArrayHelper;
use app\modules\services\CategoriesService;
/**
 * OdichController implements the CRUD actions for Odich model.
 */
class OdichController extends QuanlyBaseController
{

    public $title = "Ổ dịch";


    public function actionTaoOdichTcm( $id)
    {   
        $model =  Cabenh::findOne($id);

        $format = 'd/m/Y'; 

        $date = DateTime::createFromFormat($format, $model->ngaymacbenh,  new DateTimeZone('Asia/Ho_Chi_Minh')); 
        $dateToi = clone $date;
        $dateToi->modify('+7 days'); 
        $dateLui = clone $date;
        $dateLui->modify('-7 days'); 
        //dd($dateToi);
        if($model->loaicabenh_id == 2){
            $cabenh_lienquan = Cabenh::find()->select(['id', 'hoten', 'ngaybaocao', 'ngaymacbenh'])
            ->where(['status' => 1, 'loaibenh_id' => $model->loaibenh_id, 'loaicabenh_id' => $model->loaicabenh_id, 'status' => 1])
            ->andWhere(['truonghoc_id' => $model->truonghoc_id])
            ->andWhere(['between', 'ngaymacbenh', $dateLui->format('Y-m-d'), $dateToi->format('Y-m-d')])->asArray()->all();
           
        }else{
            $cabenh_lienquan = Cabenh::find()->select(['id', 'hoten', 'ngaybaocao', 'ngaymacbenh'])
            ->where(['status' => 1, 'loaibenh_id' => $model->loaibenh_id, 'loaicabenh_id' => $model->loaicabenh_id, 'status' => 1])
            ->andWhere(['phuongxa_noiohientai' => $model->phuongxa_noiohientai])
            ->andWhere(['khupho_noiohientai_id' => $model->khupho_noiohientai_id])
            ->andWhere(['ten_duong' => $model->ten_duong])
            ->andWhere(['between', 'ngaymacbenh', $dateLui->format('Y-m-d'), $dateToi->format('Y-m-d')])->asArray()->all();
        }

        //dd($cabenh_lienquan);

        $odich = new Odich();
        $odich->loaibenhdich_id = $model->loaibenh_id;
        $odich->ngaytaoodich = date('Y-m-d');

        $odich->loaibenhdich_id = $model->loaibenh_id;

        if($model->loaicabenh_id = 2 && $model->truonghoc_id != null){
            $odich->truonghoc_id = $model->truonghoc_id;
            $odich->xacdinhodich_id = 2;
        }elseif( $model->loaicabenh_id = 2 && $model->phuongxa_noiohientai != null ){
            $odich->xacdinhodich_id = 1;
            $odich->phuongxa = $model->phuongxa_noiohientai;
        }

        $odich->save();  

        foreach($cabenh_lienquan as $i => $item){
            $odichcabenh = new OdichCabenh(['odich_id' => $odich->id, 'cabenh_id' => $item['id']]);
            $odichcabenh->save();
        }
        

        Yii::$app->session->setFlash('success', 'Đã tạo ổ dịch TCM thành công!');
        return $this->redirect(['view', 'id' => $odich->id]);
    }

    /**
     * Lists all Odich models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new OdichSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }


    /**
     * Displays a single Odich model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $request = Yii::$app->request;

        $cabenhOdich  = OdichCabenh::find()->select(['cabenh_id'])->where(['status' => 1, 'odich_id' => $id])->asArray()->all();

        $cabenh_id = array_keys(ArrayHelper::map($cabenhOdich, 'cabenh_id', 'cabenh_id'));

       
        $cabenh = CaBenh::find()->select(['id', 'hoten', 'ngaysinh', 'phuongxa_noiohientai', 'ngaybaocao', 'ngaymacbenh'])->where(['status' => 1])
        ->andWhere(['in', 'id', $cabenh_id])->all();

        //dd($cabenh[0]->phuongxaNoiohientai->ten_dvhc);


        return $this->render('view', [
            'model' => $this->findModel($id),
            'cabenh' => $cabenh,
        ]);
    }

    /**
     * Creates a new Odich model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Odich();

        if($model->load($request->post()) && $model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
            'categories' => CategoriesService::getCategoriesCabenh(),
        ]);

    }

    /**
     * Updates an existing Odich model.
     * For ajax request will return json object
     * and for non-ajax request if update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if($model->load($request->post()) && $model->save()){
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => CategoriesService::getCategoriesCabenh(),
        ]);
    }

    /**
     * Delete an existing Odich model.
     * For ajax request will return json object
     * and for non-ajax request if deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $request = Yii::$app->request;
        $model = $this->findModel($id);

        if ($request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            if ($request->isPost) {
                $model->status = 0;
                $model->save();
                return [
                    'forcedClose' => true,
                    'redirect' => Url::to(['index'])
                ];
            } else {
                return [
                    'title' => "Xoá Odich #" . $id,
                    'content' => $this->renderAjax('delete', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Xóa',['class'=>'btn btn-danger float-start','type'=>"submit"]).
                        Html::button('Đóng',['class'=>'btn btn-light float-end','data-bs-dismiss'=>"modal"])
                ];
            }
        } else {
            return $this->redirect(['index']);
        }
    }

    
    /**
     * Finds the Odich model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Odich the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Odich::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
