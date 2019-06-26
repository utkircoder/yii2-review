<?php


namespace whiteSuit\review\behaviors;


use common\helpers\ArrayHelper;
use yii\base\Behavior;
use yii\db\ActiveRecord;
use yii\web\NotFoundHttpException;

/**
 * Class ReviewsModelBehavior
 * @package whiteSuit\review\behaviors
 *
 * $model_types = [
 *      Reviews::TYPE_PRODUCT =>[
 *           'className'=>'common\models\Product',
 *           'linkAttributeName'=>'id',
 *           'condition'=>['status'=>Product::STATUS_ACTIVE],
 *           'relationName'=>'products'
 *       ],
 *       Reviews::TYPE_ADVERT =>[
 *           'className'=>'common\models\Advert',
 *           'condition'=>[],
 *           'linkAttributeName'=>'id',
 *           'relationName'=>'adverts'
 *       ],
 *     ];
 */

class ReviewsModelBehavior extends Behavior
{
    public $attributeName;
    public $typeAttributeName;

    public $model_types = [];

    public function events()
    {
        return ArrayHelper::merge(parent::events(), [
            ActiveRecord::EVENT_AFTER_INSERT => 'afterInsert',
        ]);
    }


    /**
     * @param $event
     * @throws NotFoundHttpException
     */
    public function afterInsert($event)
    {
        /**
         * @var $owner Reviews
         */
        $owner = $this->owner;
        if(!$this->model_types || !is_array($this->model_types)){return;}

        foreach ($this->model_types as $type => $options){
            if($this->owner->{$this->typeAttributeName} == $type){
                $linkModel = $this->getLinkModel($options['className'],$options['condition'],$options['linkAttributeName']);
                $owner->link($options['relationName'],$linkModel);
            }
        }
    }


    /**
     * @param $className ActiveRecord
     * @param $condition
     * @param $linkAttributeName
     * @return mixed
     * @throws NotFoundHttpException
     */
    protected function getLinkModel($className,$condition,$linkAttributeName)
    {
        $model = $className::find()->andWhere([$linkAttributeName=>$this->owner->{$this->attributeName}]);
        if($condition){
            $model->andWhere($condition);
        }
        $model = $model->one();
        if(!$model){
            throw new NotFoundHttpException(\Yii::t('app','Model is not found'));
        }
        return $model;
    }

}