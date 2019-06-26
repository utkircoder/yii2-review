<?php
/**
 * @var $model \common\models\Product|\common\models\Advert | \yii\db\ActiveRecord
 * @var $this \yii\web\View
 * @var $reviewForm \common\modules\review\forms\ReviewForm
 * @var $action string
 * @var $reviews \common\modules\review\models\Reviews[]
 */
\common\modules\review\assets\JqueryStarAsset::register($this);

use yii\bootstrap\ActiveForm;
use yii\helpers\Html; ?>

<span class="my-rating-9"></span>
<span class="live-rating"></span>


<?php $form = ActiveForm::begin([
        'id' => 'review-form',
        'class' => 'forms',
        'action' => $action
]); ?>

<?= $form->field($reviewForm, 'name')->textInput(['autofocus' => true]) ?>
<?= $form->field($reviewForm, 'comment')->textarea(['autofocus' => true]) ?>
<?= $form->field($reviewForm, 'rating')->hiddenInput(['class'=>'rating-input'])->label(false); ?>
<?= $form->field($reviewForm, 'type')->hiddenInput()->label(false); ?>
<?= $form->field($reviewForm, 'model_id')->hiddenInput()->label(false); ?>
<div class="form-group">
    <?= Html::submitButton(Yii::t('app','Send'), ['class' => 'standart_button mt-3', 'name' => 'login-button']) ?>
</div>

<?php ActiveForm::end(); ?>

<?php if($reviews): ?>

    <div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="page-header">
                <h1><small class="pull-right"><?=count($reviews)?> <?=Yii::t('app','comments')?></small></h1>
            </div>
            <div class="comments-list">
                <?php foreach ($reviews as $review):?>
                 <div class="media">
                    <div class="media-body">

                        <h4 class="media-heading user_name"><b><?=Yii::t('app','User name')?></b>:<?=$review->name?></h4>
                        <b><?=Yii::t('app','Comment')?></b>:<?=$review->comment?>

                        <p><div class="my-rating-comment" data-rating="<?=$review->rating?>"></div></p>
                    </div>
                </div>
               <?php endforeach;?>
            </div>

        </div>
    </div>
</div>

<?php endif;?>




<?php

$js = <<<JS
 $(".my-rating-9").starRating({
    initialRating: 0,
    disableAfterRate: false,
   onHover: function(currentIndex, currentRating, el){
      $('.rating-input').val(currentIndex);
    },
    onLeave: function(currentIndex, currentRating, el){
      $('.rating-input').val(currentRating);
    }
   
  });
 $(".my-rating-comment").starRating({
    readOnly: true,
    starSize: 24
  });

JS;

$css = <<<CSS

.user_name{
    font-size:14px;
}
.comments-list .media{
    border-bottom: 1px dotted #ccc;
}
CSS;


$this->registerJs($js);
$this->registerCss($css);
?>
