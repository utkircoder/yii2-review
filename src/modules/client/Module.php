<?php

namespace common\modules\review\modules\client;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'common\modules\review\modules\client\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        parent::init();
        \Yii::configure($this, require __DIR__ . '/config.php');

        // custom initialization code goes here
    }
}
