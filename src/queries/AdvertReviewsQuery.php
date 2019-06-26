<?php

namespace common\modules\review\queries;

/**
 * This is the ActiveQuery class for [[\common\modules\review\models\AdvertReviews]].
 *
 * @see \common\modules\review\models\AdvertReviews
 */
class AdvertReviewsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\modules\review\models\AdvertReviews[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\review\models\AdvertReviews|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
