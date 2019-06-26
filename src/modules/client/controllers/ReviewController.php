<?php


namespace common\modules\review\modules\client\controllers;


use common\components\DdHelper;
use common\components\SessionFlash;
use common\modules\review\forms\ReviewForm;
use common\modules\review\models\Reviews;
use yii\web\Controller;
use Yii;
class ReviewController extends Controller
{
    public $enableCsrfValidation=false;

    public function actionAdd()
    {

        $model = new ReviewForm();
        if($model->load(\Yii::$app->request->post()) && $model->validate()){
            $review = new Reviews();
            $review->rating = $model->rating;
            $review->comment = $model->comment;
            $review->name = $model->name;
            $review->type = $model->type;
            $review->scenarioSet();
            $review->user_id = $model->user_id;
            $review->session_id = $model->session_id;
            $review->status = Reviews::STATUS_DEACTIVE;
            $review->modelid = $model->model_id;
            if(!$review->save()){
                SessionFlash::error(Yii::t('app','Review is not added'));
            }else {
                SessionFlash::success(Yii::t('app', 'Review is successfull added'));
            }
            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        }
        SessionFlash::error(Yii::t('app','Review is not added'));
        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);

    }

}