<?php
namespace App\Model;


class CartCollection
    implements \IteratorAggregate
{
    private $_userFilter;
    private $_resource;

    public function __construct(Resource\IResourceCollection $resource)
    {
        $this->_resource = $resource;
    }

    public function getAverageRating()
    {

    }

    public function getItemCarts($userId)
    {
        $this->_resource->filterBy("customer_id", $userId);
        return $this->_resource->fetch();
    }
    public function getProduct($productId)
    {
        $this->_resource->filterBy("product_id", $productId);
        return $this->_resource->fetch();
    }


    public function getIterator()
    {
        return new \ArrayIterator($this->getReviews());
    }
}