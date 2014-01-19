<?php
namespace App\Model;

use App\Model\Resource\IResourceEntity;

class Admin extends Entity
{
    public function getName()
    {
        return $this->_getData('name');
    }

    public function getPassword()
    {
        return $this->_getData('password');
    }
}
