<?php
namespace App\Model;

class City extends Entity
{
    public function getName()
    {
        return $this->_getData('name');
    }

    public function getRegionId()
    {
        return $this->_getData('region_id');
    }

    public function getPrice()
    {
        return $this->_getData('shipping_price');
    }

    public function getId()
    {
        return $this->_getData('city_id');
    }



}