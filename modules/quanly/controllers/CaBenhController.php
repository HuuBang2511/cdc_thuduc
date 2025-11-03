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
        $dataProvider = $searchModel->search($queryParams);

        if ($request->isPost && $searchModel->load($request->post())) {
             $url = ['index'];
            foreach ($request->post()['CaBenhSearch'] as $i => $item) {
                $url = array_merge($url,["CaBenhSearch[$i]" => $item]);
            }
            return $this->redirect($url);
        }

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

            if($model->is_dieutra == 1){
                $model->tinhtrang_dieutra = 'ĐÃ ĐIỀU TRA';
            }else{
                $model->tinhtrang_dieutra = 'CHƯA ĐIỀU TRA';
            }

            if($model->ngaybaocao != null){
                $date = new DateTime($model->ngaybaocao); 
                $date->modify('+7 days'); 
                $model->ngayhandieutra = $date->format('d/m/Y'); 
                //dd($model->ngayhandieutra);
            }
            $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'categories' => CategoriesService::getCategoriesCabenh(),
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
