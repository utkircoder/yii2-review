<?php


namespace whiteSuit\review\helpers;



class ReviewCalculateHelper
{


    /**
     * @param $product Product
     * @throws \yii\db\Exception
     */
    public static function productRating($product)
    {
        $reviews = $product->reviews;
        if($reviews) {
            $rating = 0;
            foreach ($reviews as $review) {
                $rating += floatval($review->rating);
            }
            $product->rating = (string)floatval($rating / count($reviews));
        }
        \Yii::$app->db->createCommand("UPDATE product SET rating=:rating WHERE id=:id")
            ->bindValue(':id', $product->id)
            ->bindValue(':rating', $product->rating)
            ->execute();
    }

    /**
     * @param $model Advert
     * @throws \yii\db\Exception
     */
    public static function advertRating($model)
    {
        $reviews = $model->reviews;
        if($reviews) {
            $rating = 0;
            foreach ($reviews as $review) {
                $rating += floatval($review->rating);
            }
            $model->rating = (string)floatval($rating / count($reviews));
        }
        \Yii::$app->db->createCommand("UPDATE advert SET rating=:rating WHERE id=:id")
            ->bindValue(':id', $model->id)
            ->bindValue(':rating', $model->rating)
            ->execute();
    }

}