<?php
require_once __DIR__ . '/Entity.php';
class Review extends Entity
{
    public function getName()
    {
        return $this->_getData('name');
    }

    public function getEmail()
    {
        return $this->_getData('email');
    }

    public function getText()
    {
        return $this->_getData('text');
    }

    public function getRating()
    {
        return $this->_getData('rating');
    }

    public function belongsToProduct($product)
    {
        return (bool) ($product == $this->_getData('product')) ? true : false;
    }


} 