<?php

namespace App\Model;

class CustomerCollection
    implements \IteratorAggregate
{
    private $_resource;

    public function __construct(Resource\IResourceCollection $resource)
    {
        $this->_resource = $resource;
    }

    public function getUser($data)
    {
        foreach ($data as $key => $value)
        {
            $this->_resource->filterBy($key, $value);
        }

        return reset($this->_resource->fetch());
    }

    public function getCustomers()
    {
        return array_map(
            function($data) {
                return new Customer($data);
            },
            $this->_resource->fetch()
        );
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->getCustomer());
    }
}