<?php


namespace whiteSuit\review\assets;


use yii\web\AssetBundle;

class JqueryStarAsset extends AssetBundle
{
    public $sourcePath = '@vendor/whiteSuit/review/assets/assets';

    public $js = [
        'js/jquery.star-rating-svg.js'
    ];
    public $css =[
        'css/star-rating-svg.css'
    ];

    public $depends = [
        'yii\web\JqueryAsset',
    ];
}