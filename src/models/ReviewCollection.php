<?php
namespace App\Model;


class ReviewCollection
    implements \IteratorAggregate
{
    private $_productFilter;
    private $_resource;

    public function __construct(Resource\IResourceCollection $resource)
    {
        $this->_resource = $resource;
    }

    public function getAverageRating()
    {
        return $this->_resource->Average('rating');

    }

    public function filterByProduct($product)
    {
        $this->_resource->filterBy('product_id', $product->getId());
    }

    public function getReviews()
    {
        return array_map(
            function($data) {
                return new Review($data);
            },$this->_resource->fetch()
        );

    }

    public function getIterator()
    {
        return new \ArrayIterator($this->getReviews());
    }
}