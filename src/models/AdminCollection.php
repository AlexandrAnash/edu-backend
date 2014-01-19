<?php

namespace App\Model;

class AdminCollection
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

    public function getAdmin()
    {
        return array_map(
            function($data) {
                return new Admin($data);
            },
            $this->_resource->fetch()
        );
    }

    public function getIterator()
    {
        return new \ArrayIterator($this->getAdmin());
    }
}