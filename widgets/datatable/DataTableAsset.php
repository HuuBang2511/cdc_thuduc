<?php


namespace app\widgets\datatable;


use yii\web\AssetBundle;

class DataTableAsset extends AssetBundle
{
    public function init()
    {
        $this->sourcePath = __DIR__ . '/assets';
        parent::init();
    }

    public $publishOptions = [
        'forceCopy' => YII_ENV_DEV //dev
    ];

    public $css = [
        'css/fixedColumns.dataTables.css',
        'css/buttons.dataTables.css',
        'css/dataTables.bootstrap5.min.css',
    ];

    public $js = [
        'js/dataTables.js',
        'js/moment.min.js',
        'js/dataTables.fixedColumns.js',
        'js/fixedColumns.dataTables.js',
        'js/dataTables.buttons.js',
        'js/buttons.dataTables.js',
        'js/jszip.min.js',
        'js/pdfmake.min.js',
        'js/vfs_fonts.js',
        'js/buttons.html5.min.js',
        'js/buttons.print.min.js',
        'js/buttons.bootstrap5.min.js',
        'js/dataTables.bootstrap5.min.js',
    ];
}