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
    public $sourcePath = '@vendor/almasaeed2010/adminlte';
    public $css = [
        '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.1.0/css/font-awesome.min.css',
        '//code.ionicframework.com/ionicons/1.5.2/css/ionicons.min.css',
        'css/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css',
        'css/AdminLTE.css'
    ];
    public $js = [
        'js/AdminLTE/app.js',
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapPluginAsset'
    ];

}