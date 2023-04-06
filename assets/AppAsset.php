<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * Main application asset bundle.
 *
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/site.css',
        'css/custom.css',
        'template/vendor/fontawesome-free/css/all.min.css',
        'template/css/sb-admin-2.min.css',
        'template/vendor/datatables/dataTables.bootstrap4.min.css',

    ];
    public $js = [
        // Bootstrap core JavaScript
        'template/vendor/jquery/jquery.min.js',    
        'template/vendor/bootstrap/js/bootstrap.bundle.min.js',

        // Core plugin JavaScript
        'template/vendor/jquery-easing/jquery.easing.min.js',

        // Custom scripts for all pages
        'template/js/sb-admin-2.min.js',

        // Page level plugins
        'template/vendor/chart.js/Chart.min.js',

        // Page level custom scripts
        'template/js/demo/chart-area-demo.js',
        'template/js/demo/chart-pie-demo.js',    
        
        // Datatable plugin
        'template/vendor/datatables/jquery.dataTables.min.js',        
        'template/vendor/datatables/dataTables.bootstrap4.min.js',        
        
        // Datatable plugin custom
        'template/js/demo/datatables-demo.js',        


    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap5\BootstrapAsset'
    ];
}
