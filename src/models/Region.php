<?php
namespace App\Model;

use App\Model\Resource\IResourceEntity;

class Region extends Entity
{
    public function getName()
    {
        return $this->_getData('name');
    }

    public function getId()
    {
        return $this->_getData('region_id');
    }

    public function save(IResourceEntity $resource = null)
    {
        if (!$resource) {
            $resource = $this->_resource;
        }
        $id = $resource->save($this->_data);
        $this->_data['region_id'] = $id;
    }
}