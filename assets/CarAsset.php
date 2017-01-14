<?php

namespace app\assets;

use yii\web\AssetBundle;

class CarAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'css/car.css',
    ];
    public $js = [
        'js/car.js',
    ];
    public $depends = [
        'app\assets\AppAsset',
        'yii\web\JqueryAsset',
    ];
}
