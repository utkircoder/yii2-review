<?php

/**
 * @var $model \common\modules\review\models\Reviews
 */

use yii\widgets\DetailView;

\common\modules\review\assets\JqueryStarAsset::register($this);
?>

<?php if($model): ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=>'Type',
                'value'=>function(\common\modules\review\models\Reviews $model ){
                    return $model->getTypeName();
                },
                'format'=>'raw'
            ],
            [
                'attribute'=>'Model',
                'value'=>function(\common\modules\review\models\Reviews $model ){
                    return $model->getReviewedModelInfo();
                },
                'format'=>'raw'
            ],
            'comment:ntext',
            'name',
        ],
    ]) ?>

<?php else:?>
    <h1><?=Yii::t('app','Review not found')?></h1>
<?php endif;?>




<?php

$js = <<<JS
 $(".my-rating-9").starRating({
   readOnly: true
  });

JS;

$this->registerJs($js);

?>
