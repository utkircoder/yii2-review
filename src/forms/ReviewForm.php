<?php


namespace whiteSuit\review\forms;


use Yii;
use yii\base\Model;

class ReviewForm extends Model
{

    public $type;
    public $rating;
    public $comment;
    public $name;
    public $model_id;
    public $session_id;
    public $user_id;

    public function init()
    {
      if(Yii::$app->user->isGuest){
          $this->session_id = $this->getUserSessionId();
          $this->user_id = null;
      }else{
          $this->session_id = null;
          $this->user_id = Yii::$app->user->getId();
      }
    }

    public function rules()
    {
        return [
          [['model_id','name','rating','comment','type'],'required'],
            [['user_id','session_id'],'safe']
        ];
    }


    public function getUserSessionId()
    {
        $session = Yii::$app->session;
        if (!$session->isActive) {
            $session->open();
        }
        return Yii::$app->session->getId();
    }

}