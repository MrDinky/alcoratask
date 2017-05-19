<?php

namespace frontend\modules\alcora\assets;

use yii\web\AssetBundle;


class MainAsset extends AssetBundle
{
    public $sourcePath = '@frontend/modules/alcora/web/';
    public $css = [
        'css/alcora_main.css',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
