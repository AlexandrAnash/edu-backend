<?php
namespace App\Model;

use App\Model\Resource\IResourceEntity;

class Customer extends Entity
{
    public function save(IResourceEntity $resource)
    {
        $id = $resource->save($this->_data);
        $this->_data['customer_id'] = $id;
    }

    public function getName()
    {
        return $this->_getData('name');
    }

    public function getPassword()
    {
        return $this->_getData('password');
    }

    public function getRating()
    {
        return $this->_getData('rating');
    }

    public function getId()
    {
        return $this->_getData('customer_id');
    }
}
