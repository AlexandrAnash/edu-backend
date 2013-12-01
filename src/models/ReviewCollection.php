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
        if (!$this->_productFilter)
        {
            $temp = $this->_resource->Average('rating');
            return $temp;
        }
        $this->_resource->filterBy('product_id', $this->_productFilter->getProductId());

        return $this->_resource->Average('rating');

    }

    public function filterByProduct($product)
    {
        $this->_productFilter = $product;
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
        $this->_resource->filterBy('product_id', $this->_productFilter->getProductId());
        return array_map(
            function($data) {
                return new Review($data);
            },$this->_resource->whereProduct()
        );

    }

    public function getIterator()
    {
        return new ArrayIterator($this->getReviews());
    }
}