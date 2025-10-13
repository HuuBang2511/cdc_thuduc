<?php


namespace app\modules\quanly\controllers;


use app\modules\quanly\base\QuanlyBaseController;
use app\modules\quanly\models\CaBenh;
use Yii;

class DashboardController extends QuanlyBaseController
{
    public function actionIndex()
    {
        $thongke['cabenh_congdong'] = CaBenh::find()->where(['status' => 1, 'loaicabenh_id' => 1])->count();
        $thongke['cabenh_nhatruong'] = CaBenh::find()->where(['status' => 1, 'loaicabenh_id' => 2])->count();
        $thongke['cabenh_sxh'] = CaBenh::find()->where(['status' => 1, 'chandoanchinh_id' => 1])->count();
        $thongke['cabenh_tcm'] = CaBenh::find()->where(['status' => 1, 'chandoanchinh_id' => 2])->count();


        return $this->render('index', [
            'thongke' => $thongke,
        ]);
    }

    public function actionGeojson(){
        $dmas = Yii::$app->db->createCommand('SELECT st_asgeojson(geom) as geometry, madma as ten, id  FROM "v2_4326_DMA" order by madma')->queryAll();

        $g  = [];

        foreach ($dmas as $i => $dma) {
            $geometry = json_decode($dma['geometry'], true);
            $g[$i] = [
                'type' => 'Feature',
                'id' => $dma['id'],
                'properties' => [
                    'name' => $dma['ten'],
                ],
                'geometry' => [
                    'type' => $geometry['type'],
                    'coordinates' => $geometry['coordinates'],
                ]
            ];
        }

        $e = [
            'type' => 'FeatureCollection',
            'features' => $g
        ];

        //dd($e);
        return json_encode($e, JSON_UNESCAPED_UNICODE);

        //dd($results);
    }

    public function actionChitietdma($id){

        

      
       

       return $this->renderAjax('chitietdma', [
           'id'=>$id,
           
       ]); 
   }


}