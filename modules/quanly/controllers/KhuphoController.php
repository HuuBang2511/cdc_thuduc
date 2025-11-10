<?php

namespace app\modules\quanly\controllers;

use Yii;
use app\modules\quanly\models\Khupho;
use app\modules\quanly\models\KhuphoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use \yii\web\Response;
use yii\helpers\Html;
use yii\helpers\Url;
use app\modules\quanly\base\QuanlyBaseController;
use app\modules\services\CategoriesService;

/**
 * KhuphoController implements the CRUD actions for Khupho model.
 */
class KhuphoController extends QuanlyBaseController
{

    public $title = "Khu phố";

    /**
     * Lists all Khupho models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new KhuphoSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'categories' => CategoriesService::getCategoriesCabenh(),
        ]);
    }


    /**
     * Displays a single Khupho model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $geojson = Khupho::find()->select(['st_asgeojson(geom)'])->where(['id' => $id])->asArray()->one();
        
        $geojson = $geojson['st_asgeojson'];

        //dd($geojson);

        return $this->render('view', [
            'model' => $this->findModel($id),
            'geojson' => $geojson,
        ]);
    }

    /**
     * Creates a new Khupho model.
     * For ajax request will return json object
     * and for non-ajax request if creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $request = Yii::$app->request;
        $model = new Khupho();

        if($request->isAjax){
            /*
            *   Process for ajax request
            */
            Yii::$app->response->format = Response::FORMAT_JSON;
            if($request->isGet){
                return [
                    'title'=> "Thêm mới Khupho",
                    'content'=>$this->renderAjax('create', [
                        'model' => $model,
                    ]),
                    'footer'=> Html::button('Lưu',['class'=>'btn btn-primary float-start','type'=>"submit"]).
                            Html::button('Đóng',['class'=>'btn btn-light float-end','data-bs-dismiss'=>"modal"])
                ];
            }else if($model->load($request->post()) && $model->save()){
                return [
                    'forceReload'=>'#crud-datatable-pjax',
                    'title'=> "Thêm mới Khu phố",
                    'content'=>'<span class="text-success">Thêm mới Khu phố thành công</span>',
                    'footer'=> Html::a('Tiếp tục thêm mới',['create'],['class'=>'btn btn-primary float-start','role'=>'modal-remote']).
                            Html::button('Đóng',['class'=>'btn btn-light float-end','data-bs-dismiss'=>"modal"])
                ];
            }else{
                return [
                    'title'=> "Thêm mới Khu phố",
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
     * Updates an existing Khupho model.
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
        ]);
    }

    

    /**
     * Delete an existing Khupho model.
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
                    'title' => "Xoá Khupho #" . $id,
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
     * Finds the Khupho model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Khupho the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Khupho::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
