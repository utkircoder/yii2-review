<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\modules\review\models\Reviews */

$this->title = Yii::t('app', 'Create Reviews');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Reviews'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reviews-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
