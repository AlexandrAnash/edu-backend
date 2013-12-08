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
            },$this->_resource->fetch()
        );

    }

    public function getIterator()
    {
        return new \ArrayIterator($this->getReviews());
    }
}