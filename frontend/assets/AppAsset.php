<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $css = [
        'css/site.css',
    ];

    public $js = [
        '/js/card.js'
    ];

    public $depends = [
        \yii\web\JqueryAsset::class,
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
