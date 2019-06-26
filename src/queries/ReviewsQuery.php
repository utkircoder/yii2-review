<?php

namespace common\modules\review\queries;

use common\modules\review\models\Reviews;

/**
 * This is the ActiveQuery class for [[\common\modules\review\models\Reviews]].
 *
 * @see \common\modules\review\models\Reviews
 */
class ReviewsQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\modules\review\models\Reviews[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\modules\review\models\Reviews|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function active()
    {
        return $this->andWhere(['reviews.status' => Reviews::STATUS_ACTIVE]);
    }
    public function deactive()
    {
        return $this->andWhere(['reviews.status' => Reviews::STATUS_DEACTIVE]);
    }

    public function id($id)
    {
        return $this->andWhere(['reviews.id' => $id]);
    }

    public function productId($id)
    {
        return $this->andWhere(['product.id' => $id]);
    }

    public function advertId($id)
    {
        return $this->andWhere(['advert.id' => $id]);
    }
    public function joinProducts()
    {
        return $this->joinWith(['products']);
    }
    public function joinAdverts()
    {
        return $this->joinWith(['adverts']);
    }

    public function joinUser()
    {
        return $this->joinWith(['user']);
    }

}
