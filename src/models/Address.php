<?php

namespace App\Model;
use App\Model\Resource\IResourceEntity;

class Address extends Entity
{
    public function getCity(IResourceEntity $cityResource)
    {
        return $cityResource->find($this->_getData('city_id'));
    }

    public function getId()
    {
        return $this->_getData('address_id');
    }

    public function getCityId()
    {
        return $this->_getData('city_id');
    }

    public function getRegionId()
    {
        return $this->_getData('region_id');
    }

    public function getPostalCode()
    {
        return $this->_getData('postal_code');
    }

    public function getStreet()
    {
        return $this->_getData('street');
    }

    public function getHomeNumber()
    {
        return $this->_getData('home_number');
    }

    public function getFlat()
    {
        return $this->_getData('flat');
    }

    //public function setData(array $data)
    //{
    //    $this->_data = $data;
    //}


}