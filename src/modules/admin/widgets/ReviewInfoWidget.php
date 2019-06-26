<?php


namespace common\modules\review\modules\admin\widgets;


use yii\base\Widget;

class ReviewInfoWidget extends Widget
{
    public $action;

    public function run()
    {
        return $this->render('info',[
            'action'=>$this->action
        ]);
    }

}