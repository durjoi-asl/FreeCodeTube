<?php

namespace backend\assets;

use yii\web\AssetBundle;
use yii\web\JqueryAsset;

/**
 * Main backend application asset bundle.
 */
class TagsInputAsset extends AssetBundle
{
    public $basePath = '@webroot/tagsInput';
    public $baseUrl = '@web/tagsInput';
    public $css = [
        'tagsinput.css',
    ];
    public $js = [
      'tagsinput.js',
    ];
    public $depends = [
        JqueryAsset::class,
    ];
}
