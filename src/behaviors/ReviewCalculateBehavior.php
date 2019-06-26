<?php


namespace whiteSuit\review\behaviors;


use whiteSuit\review\models\Reviews;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

class ReviewCalculateBehavior extends Behavior
{
    public $ratingAttributeName;

    public $relationName;

    public function events()
    {
        return ArrayHelper::merge(parent::events(),[
            ActiveRecord::EVENT_BEFORE_UPDATE =>'calculateRating',
            ActiveRecord::EVENT_AFTER_UPDATE =>'afterUpdate'
        ]);
    }

    public function calculateRating($event)
    {
        /**
         * @var $reviews Reviews[]
         */
     $reviews = $this->owner->{$this->relationName};
     $this->owner->{$this->ratingAttributeName} = 0;

     if(!$reviews){return ;}
     $rating = 0;
     foreach ($reviews as $review){
         $rating+=floatval($review->rating);
     }
     $this->owner->{$this->ratingAttributeName} = (string)floatval($rating/count($reviews));

    }

    public function afterUpdate($event)
    {
       # DdHelper::dd($this->owner->getAttributes());

    }

}