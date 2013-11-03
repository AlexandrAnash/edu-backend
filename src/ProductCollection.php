<?php

class ProductCollection
{
    private $__collection;
    private $__object;

    public $offset;
    public $limit;

    public function __construct($obj)
    {
        $this->__object = $obj;
        $this->limit = count($obj);
        $this->offset = 0;
    }

    public function getProducts()
    {
        $this->__collection = array();

        for ($i=$this->offset; $i<$this->limit; $i++)
        {
            $this->__collection[$i - $this->offset] = $this->__object[$i];
        }
        return $this->__collection;
    }

    public function getSize()
    {
        return $this->limit;
    }

    public function limit($limit)
    {
        $this->limit = $limit;
    }

    public function offset($offset)
    {
        $this->offset = $offset;
    }
}