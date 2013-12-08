<?php
namespace App\Model;
use App\Model\Resource\IResourceEntity;

class Cart extends Entity
{
    public function save(IResourceEntity $resource)
    {
        $id = $resource->save($this->_data);
        $this->_data['customer_id'] = $id;
    }

    public function getCount()
    {
        return $this->_getData('count');
    }
    public function getProductId()
    {
        return $this->_getData('product_id');
    }
    public function getCustomerId()
    {
        return $this->_getData('customer_id');
    }
    public function getId()
    {
        return $this->_getData('cart_id');
    }



}
