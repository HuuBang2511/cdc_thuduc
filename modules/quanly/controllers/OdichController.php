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
        if($model->loaicabenh_id = 2){
            $cabenh_lienquan = Cabenh::find()->select(['id', 'hoten', 'ngaybaocao', 'ngaymacbenh'])
            ->where(['status' => 1, 'loaibenh_id' => $model->loaibenh_id, 'loaicabenh_id' => $model->loaicabenh_id, 'status' => 1])
            ->andWhere(['truonghoc_id' => $model->truonghoc_id])
            ->andWhere(['between', 'ngaymacbenh', $dateLui->format('Y-m-d'), $dateToi->format('Y-m-d')])->asArray()->all();
           
        }else{
            $cabenh_lienquan = Cabenh::find()->select(['id', 'hoten'])
            ->where(['status' => 1, 'loaibenh_id' => $model->loaibenh_id, 'loaicabenh_id' => $model->loaicabenh_id, 'status' => 1])
            ->andWhere(['phuongxa_noiohientai' => $model->phuongxa_noiohientai])
            ->andWhere(['khupho_noiohientai_id' => $model->khupho_noiohientai_id])
            ->andWhere(['ten_duong' => $model->ten_duong])
            ->andWhere(['between', 'ngaymacbenh', $dateLui->format('Y-m-d'), $dateToi->format('Y-m-d')])->asArray()->all();
        }

        $odich = new Odich();
        $odich->loaibenhdich_id = $model->loaibenh_id;
        $odich->ngaytaoodich = date('Y-m-d');
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
        if($request->isAjax){
            Yii::$app->response->format = Response::FORMAT_JSON;
            return [
                    'title'=> "Odich #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $this->findModel($id),
                    ]),
                    'footer'=> Html::a('Cập nhật',['update','id'=>$id],['class'=>'btn btn-primary float-start','role'=>'modal-remote']).
                            Html::button('Đóng',['class'=>'btn btn-light float-end','data-bs-dismiss'=>"modal"])
                ];
        }else{
            return $this->render('view', [
                'model' => $this->findModel($id),
            ]);
        }
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

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Thêm mới Odich",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Lưu',['class'=>'btn btn-primary float-start','type'=>"submit"]).
                            Html::button('Đóng',['class'=>'btn btn-light float-end','data-bs-dismiss'=>"modal"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Thêm mới Odich",
                    'content'=>'<span class="text-success">Thêm mới Odich thành công</span>',
                    'footer'=> Html::a('Tiếp tục thêm mới',['create'],['class'=>'btn btn-primary float-start','role'=>'modal-remote']).
                            Html::button('Đóng',['class'=>'btn btn-light float-end','data-bs-dismiss'=>"modal"])
                ];
            }else{
                return [
                    'title'=> "Thêm mới Odich",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Lưu',['class'=>'btn btn-primary float-start','type'=>"submit"]).
                            Html::button('Đóng',['class'=>'btn btn-light float-end','data-bs-dismiss'=>"modal"])

                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
        }

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

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Cập nhật Odich #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Lưu',['class'=>'btn btn-primary float-start','type'=>"submit"]).
                            Html::button('Đóng',['class'=>'btn btn-light float-end','data-bs-dismiss'=>"modal"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Odich #".$id,
                    'content'=>$this->renderAjax('view', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Đóng',['class'=>'btn btn-light float-end','data-bs-dismiss'=>"modal"]).
                            Html::a('Cập nhật',['update','id'=>$id],['class'=>'btn btn-primary float-start','role'=>'modal-remote'])
                ];
            }else{
                 return [
                    'title'=> "Cập nhật Odich #".$id,
                    'content'=>$this->renderAjax('update', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Lưu',['class'=>'btn btn-primary float-start','type'=>"submit"]).
                            Html::button('Đóng',['class'=>'btn btn-light float-end','data-bs-dismiss'=>"modal"])
                ];
            }
        }else{
            /*
            *   Process for non-ajax request
            */
            if ($model->load($request->post()) && $model->save()) {
                return $this->redirect(['view', 'id' => $model->id]);
            } else {
                return $this->render('update', [
                    'model' => $model,
                ]);
            }
        }
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
