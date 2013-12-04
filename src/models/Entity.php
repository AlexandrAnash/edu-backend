<?php
namespace App\Model;

class Entity {

    protected $_data = array();

    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    protected function _getData($key)
    {
        return isset($this->_data[$key]) ? $this->_data[$key] : null;
    }


    public function load(Resource\IResourceEntity $resource, $id)
    {
        $this->_data = $resource->find($id);
    }
}