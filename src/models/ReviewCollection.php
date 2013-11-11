<?php
require_once __DIR__ . '/EntityCollection.php';
class ReviewCollection extends EntityCollection
{
    private $_productFilter;

    public function getReviews()
    {
        $reviews = $this->getEntity();
        return $this->_applyProductFilter($reviews);
    }

    public function getAverageRating()
    {
        $reviews = array_map(function(Review $review)
        {
            return $review->getRating();
        }, $this->getReviews());

        return array_sum($reviews)/count($reviews);
    }

    public function filterByProduct($product)
    {
        $this->_productFilter = $product;
    }

    private function _applyProductFilter($reviews)
    {
        if (!$this->_productFilter)
        {
            return $reviews;
        }
        return array_filter($reviews, function (Review $reviews)
        {
            return $reviews->belongsToProduct($this->_productFilter);
        });
    }
} 