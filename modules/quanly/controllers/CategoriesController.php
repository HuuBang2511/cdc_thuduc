<?php


namespace app\modules\quanly\controllers;


use app\modules\quanly\models\Khupho;
use yii\web\Controller;
use Yii;
use yii\web\Response;
use yii\db\Query;

class CategoriesController extends Controller
{
    public function actionPhuongxa()
    {
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $quanhuyen = (string) $parents[0];
                $out = HcPhuongxa::find()->select('id as id, ten as name')
                    ->where(['quanhuyen_id' => $quanhuyen])
                    ->orderBy('ten')
                    ->asArray()
                    ->all();
                return ['output' => $out, 'selected' => ''];
            }
        }
        return ['output' => '', 'selected' => ''];
    }

    public function actionKhupho(){

    }

    public function actionGetKhupho(){
        Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
       
        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if ($parents != null) {
                $phuongxa_id = $parents[0];
                
               
                $query = new Query;

                $query->select([
                    'id as id',
                    "ten_dvhc as name"
                ])
                ->from('khupho')
                ->andWhere(['maphuong' => $phuongxa_id])
                ->orderBy('ten_dvhc');
                $command = $query->createCommand();
                $data = $command->queryAll();

                return ['output'=>array_values($data), 'selected'=>''];
            }

            
        }
        return ['output' => '', 'selected' => ''];
    }

    public function actionGetTenduong(){
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if (!empty($parents[0])) {
                $khupho_id = $parents[0];

                // Tìm khu phố (nếu cần kiểm tra)
                $khupho = Khupho::findOne($khupho_id);
               

                $query = new \yii\db\Query();
                $data = $query->select([
                        'id AS id',
                        'name AS name'   
                    ])
                    ->from('giaothong')
                    ->where(['id_kp' => $khupho->id_khupho])  
                    ->orderBy('name')
                    ->all();

                return ['output' => array_values($data), 'selected' => ''];
            }
        }

        return ['output' => [], 'selected' => ''];
    }

    public function actionGetLophoc(){
        Yii::$app->response->format = Response::FORMAT_JSON;

        if (isset($_POST['depdrop_parents'])) {
            $parents = $_POST['depdrop_parents'];
            if (!empty($parents[0])) {
                $truonghoc_id = $parents[0];

                $query = new \yii\db\Query();
                $data = $query->select([
                        'id AS id',
                        'tenlop AS name'   
                    ])
                    ->from('lophoc')
                    ->where(['truonghoc_id' => $truonghoc_id])  
                    ->orderBy('name')
                    ->all();

                return ['output' => array_values($data), 'selected' => ''];
            }
        }

        return ['output' => [], 'selected' => ''];
    }
}