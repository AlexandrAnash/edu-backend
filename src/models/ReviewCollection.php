<?php

require_once __DIR__ . '/Resource/IResourceCollection.php';
require_once __DIR__ . '/EntityCollection.php';
require_once __DIR__ . '/Review.php';
class ReviewCollection
    implements IteratorAggregate
{
    private $_productFilter;
    private $_resource;

    public function __construct(IResourceCollection $resource)
    {
        $this->_resource = $resource;
    }

   //public function getReviews()
   //{
   //    $reviews = $this->getEntity();
   //    return $this->_applyProductFilter($reviews);
   //}

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

    public function getAverage()
    {

            return reset($this->_resource->whereAverage('rating', 'product_id', $this->_productFilter->getProductId())[0]);
    }

    public function getReviews()
    {
        if (!$this->_productFilter)
        {
            return array_map(
                function($data) {
                    return new Review($data);
                }, $this->_resource->fetch()
            );
        }
        return array_map(
            function($data) {
                return new Review($data);
            }, $this->_resource->whereProduct('product_id', $this->_productFilter->getProductId())
        );

    }

    public function getIterator()
    {
        return new ArrayIterator($this->getReviews());
    }
}