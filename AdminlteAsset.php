<?php

namespace dee\adminlte;

/**
 * AdminLteAsset
 *
 * @author Misbahul D Munir <misbahuldmunir@gmail.com>
 * @since 1.0
 */
class AdminlteAsset extends \yii\web\AssetBundle
{
    public $sourcePath = '@dee/adminlte/assets/dist';
    public $css = [
//        'css/font-awesome.min.css',
//        'css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        'css/AdminLTE.min.css',
        'css/skins/_all-skins.min.css',
    ];
    public $js = [
        'js/app.js',
    ];
    public $depends = [
        'yii\bootstrap\BootstrapPluginAsset',
    ];

}