<?php

class ProductCollection
{
    private $_collection;

    public $_offset;
    public $_limit;

    public function __construct($obj)
    {
        $this->_collection = $obj;
    }

    public function getProducts()
    {
        return array_slice($this->_collection, $this->_offset, $this->_limit);
    }

    public function getSize()
    {
        return count($this->getProducts());
    }

    public function limit($limit)
    {
        $this->_limit = $limit;
    }

    public function offset($offset)
    {
        $this->_offset = $offset;
    }
}