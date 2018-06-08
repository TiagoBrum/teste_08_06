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
        "css/bootstrap.min.css",
        "css/font-awesome.min.css",
        "css/style_1.css",
    ];
    public $js = [
        "js/jquery-3.2.1.min.js",
        "js/bootstrap.min.js",
        "assets/angular/angular.min.js",
        "assets/angular/i18n/angular-locale_pt-br.js",
        "assets/angular/angular-route.min.js",
        "js/moment-with-locales.js",
        "js/angular-drag-and-drop-lists.js",
        "app/app.js",
        "app/controllers/controller.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
