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
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Reviews'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'user_id',
            'session_id',
            [
                'attribute' => 'status',
                'value' => function(\common\modules\review\models\Reviews $model){
                    return $model->getStatusName();
                },
                'filter' => Html::activeDropDownList($searchModel,'status',\common\modules\review\models\Reviews::getStatusDropdown(),['class'=>'form-control','prompt'=>Yii::t('app','Select Status')]),
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
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>


<?php

$js = <<<JS
 $(".my-rating-5").starRating({
  readOnly: true,
  starSize: 24
});
JS;

$this->registerJs($js);

?>