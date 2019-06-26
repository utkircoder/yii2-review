<?php


namespace common\modules\review\modules\admin\controllers;


use common\components\DdHelper;
use common\components\SessionFlash;
use common\models\Cart;
use common\models\Order;
use common\modules\review\helpers\ReviewCalculateHelper;
use common\modules\review\models\Reviews;
use common\modules\review\searchModels\SearchReviews;
use Yii;
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class ModeratorController extends Controller
{


    public function actionIndex()
    {


        $searchModel = new SearchReviews();
        $dataProvider = $searchModel->searchModerator(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);


    }

    public function actionReviewModal()
    {
        if (Yii::$app->request->isAjax) {
            $id = Yii::$app->request->post('id', 0);
            $model = Reviews::find()->joinAdverts()->joinProducts()->joinUser()->id($id)->one();
            if ($model) {
                $this->layout = true;
                return $this->asJson([
                    'success' => true,
                    'title' => Yii::t('app', 'Info Review'),
                    'body' => $this->render('_modal_info', [
                        'model' => $model
                    ])
                ]);
            }
            return $this->asJson([
                'success' => true,
                'title' => Yii::t('app', 'Not found'),
                'body' => $this->render('_modal_info', [
                    'model' => $model
                ])
            ]);
        }
        return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
    }

    /**
     * @param $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \yii\db\Exception
     */
    public function actionActive($id)
    {
        $model = Reviews::find()->id($id)->one();

        if($model) {
            $model->status = Reviews::STATUS_ACTIVE;
            if (!$model->save(false)) {
                SessionFlash::error(Yii::t('app', 'Review is not Activated'));
                return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
            }
            $product = $model->products;
            if($product){
                ReviewCalculateHelper::productRating($product[0]);

            }
            $advert = $model->adverts;
            if($advert){
                ReviewCalculateHelper::advertRating($advert[0]);
            }
            SessionFlash::success(Yii::t('app', 'Review is successfull Activated'));
            return $this->redirect(Yii::$app->request->referrer ?: Yii::$app->homeUrl);
        }
        throw new NotFoundHttpException(Yii::t('app','Model is not found'));
    }



}