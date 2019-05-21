<?php

namespace autoxloo\yii2\config\editor;

use conquer\codemirror\CodemirrorAsset;
use yii\bootstrap\BootstrapAsset;
use yii\web\AssetBundle;

/**
 * Class ConfigEditorAsset
 */
class ConfigEditorAsset extends AssetBundle
{
    public $sourcePath = __DIR__ . '/assets';

    public $css = [
        'css/config-editor-style.css',
    ];

    public $depends = [
        BootstrapAsset::class,
        CodemirrorAsset::class,
    ];
}
