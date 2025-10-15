<?php

namespace app\widgets\maps;

use app\widgets\maps\controls\Layers;
use app\widgets\maps\functions\DefaultFunctions;
use app\services\DebugService;
use app\widgets\maps\layers\Marker;
use app\widgets\maps\layers\TileLayer;
use app\widgets\maps\types\Icon;
use app\widgets\maps\types\LatLng;
use app\widgets\maps\types\Point;
use yii\base\InvalidConfigException;
use yii\base\Widget;
use yii\helpers\Html;
use yii\helpers\Json;
use yii\web\JsExpression;

class MapView extends Widget
{

    public $geo_x;
    public $geo_y;
    public $height = '500px';
    public $options = [];
    public $styleOptions = [];
    public $name = 'mapview';
    public $iconUrl;

    public function init()
    {
        parent::init();
        if (!isset($this->options['id'])) {
            $this->options['id'] = $this->getId();
        }

        if (is_numeric($this->height)) {
            $this->height .= 'px';
        }

        if($this->iconUrl == null) {
            $this->iconUrl = "https://auth.hcmgis.vn/uploads/icon/home-64.png";
        }
        $this->styleOptions['height'] = $this->height;

        Html::addCssStyle($this->options, $this->styleOptions, false);
    }

    /**
     * Renders the map
     * @return string|void
     */
    public function run()
    {
        echo "\n" . Html::tag('div', '', $this->options);
        $this->registerScript();
    }

    /**
     * Register the script for the map to be rendered according to the configurations on the LeafLet
     * component.
     */
    public function registerScript()
    {
        $view = $this->getView();

        $center = new LatLng(['lat' => $this->geo_y, 'lng' => $this->geo_x]);

        $map = new LeafletMap([
            'center' => $center,
            'zoom' => 17,
            'name' => $this->name,
        ]);

        $map->addLayer(new TileLayer([
            'urlTemplate' => 'https://thuduc-maps.hcmgis.vn/thuducserver/gwc/service/wmts?layer=thuduc:thuduc_maps&style=&tilematrixset=EPSG:900913&Service=WMTS&Request=GetTile&Version=1.0.0&Format=image/png&TileMatrix=EPSG:900913:{z}&TileCol={x}&TileRow={y}',
            'layerName' => 'HCMGIS',
            'clientOptions' => [
                'layers' => 'hcm_map:hcm_map'
            ],
        ]));

        $map->addLayer(new Marker([
            'latlng' => $center,
            'clientOptions' => [
                'icon' => new Icon([
                    'iconUrl' => $this->iconUrl,
                    'iconSize' => new Point(['x' => 20, 'y' => 20]),
                    'iconAnchor' => new Point(['x' => 10, 'y' => 10]),
                    'popupAnchor' => new Point(['x' => 1, 'y' => -48]),
                    'className' => 'customIcon',
                ])
            ]
        ]));

        $layers_control = new Layers();
        $layers_control->setBaseLayers([
            new TileLayer([
                'urlTemplate' => 'https://maps.hcmgis.vn/geoserver/wms',
                'service' => TileLayer::WMS,
                'layerName' => 'HCMGIS',
                'clientOptions' => [
                    'layers' => 'hcm_map:hcm_map'
                ],
            ]),
            new TileLayer([
                'urlTemplate' => 'http://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
                'layerName' => 'OSM',
                'clientOptions' => [
                    'attribution' => '© OpenStreetMap contributors',
                    'maxZoom' => 22,
                ],
            ]),
            new TileLayer([
                'urlTemplate' => 'http://{s}.google.com/vt/lyrs=r&x={x}&y={y}&z={z}',
                'layerName' => 'GMAP',
                'clientOptions' => [
                    'attribution' => '© GoogleMap contributors',
                    'maxZoom' => 22,
                    'subdomains' => ['mt0', 'mt1', 'mt2', 'mt3']
                ],
            ]),
        ]);
        $map->addControl($layers_control);

        $js = $map->getJs();
        $options = Json::encode($this->options, LeafletMap::JSON_OPTIONS);
        $initMap = "{$this->name} = L.map('{$this->id}', {$options});";
        $setView = "{$this->name}.setView([{$this->geo_y}, {$this->geo_x}], {$map->getZoom()});";
        array_unshift($js, $initMap, $setView);
        $view->registerJs("function {$this->name}Init(){\n" . implode("\n", $js) . "\n};");

        $initJS = "{$this->name}Init();";

        $view->registerJs($initJS);
    }
}
