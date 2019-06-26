<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel common\modules\review\searchModels\SearchReviews */
/* @var $dataProvider yii\data\ActiveDataProvider */
\common\modules\review\assets\JqueryStarAsset::register($this);
$this->title = Yii::t('app', 'Reviews');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'status',
                'value' => function(\common\modules\review\models\Reviews $model){
                    return $model->getStatusName();
                },
                'format' => 'raw'
            ],
            [
                    'attribute' => 'rating',
                     'value' => function($model){
                     return '<div class="my-rating-5" data-rating="'.$model->rating.'">
                              
                            </div>';
                     },
                'format' => 'raw'
              ],
            [
                'attribute'=>'User type',
                'value'=>function(\common\modules\review\models\Reviews $model ){
                    return $model->getUserType();
                },
                'format'=>'raw'
            ],
            [
             'attribute' => Yii::t('app','Comment and Info'),
              'format' => 'raw',
             'value' => function(\common\modules\review\models\Reviews $model){
                 return Html::button(Yii::t('app','Info'),['class'=>'btn btn-success btn-info-review','data-id'=>$model->id]);
             }
            ],
            [
                'attribute' => Yii::t('app','Action'),
                'format' => 'raw',
                'value' => function(\common\modules\review\models\Reviews $model){
                    return Html::a(Yii::t('app','Set Active'),\yii\helpers\Url::to(['/reviews/moderator/active','id'=>$model->id]),['class'=>'btn btn-success',]);
                }
            ],
        ],
    ]); ?>
</div>


<?=\common\modules\review\modules\admin\widgets\ReviewInfoWidget::widget([
        'action'=>\yii\helpers\Url::to(['/reviews/moderator/review-modal'])
])?>


<?php

$js = <<<JS
 $(".my-rating-5").starRating({
  readOnly: true,
  starSize: 24
});
JS;

$this->registerJs($js);

?>