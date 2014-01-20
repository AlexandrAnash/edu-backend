<?php
namespace App\Model;

class OrderCollection
    implements \IteratorAggregate
{
    private $_resource;
    private $_prototype;

    private $_items = null;

    public function __construct(Resource\IResourceCollection $resource, Order $orderPrototype)
    {
        $this->_resource = $resource;
        $this->_prototype = $orderPrototype;
    }

    public function sortOrders($orderBy)
    {
        $this->_resource->sort($orderBy);
    }

    public function filterLikeByOrder($column, $value)
    {
        $value ='%' . $value . '%' ;
        $this->_resource->filterLikeBy($column, $value);
    }

    public function filterByOrder(Order $order)
    {
        $this->_resource->filterBy('order_id', $order->getId());
    }

    public function getItems()
    {

        if (!$this->_items) {
            $this->_items = array_map(
                function ($data) {
                    $item = clone $this->_prototype;
                    $item->setData($data);
                    return $item;
                },
                $this->_resource->fetch()
            );
        }

        return $this->_items;
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->getItems());
    }

}