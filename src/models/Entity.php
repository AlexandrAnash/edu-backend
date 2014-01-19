<?php
namespace App\Model;

class Entity {

    protected $_data = array();
    protected $_resource;

    public function __construct(array $data = null, Resource\IResourceEntity $resource = null)
    {
        $this->_data = $data;
        $this->_resource = $resource;
    }

    public function save()
    {
        $id = $this->_resource->save($this->_data);

        $this->_data[$this->_resource->getPrimaryKeyField()] = $id;
    }

    public function getId()
    {
        return $this->_getData($this->_resource->getPrimaryKeyField());
    }

    protected function _getData($key)
    {
        return isset($this->_data[$key]) ? $this->_data[$key] : null;
    }

    public function setData($data)
    {
        $id = $this->getId();
        $this->_data = $data;
        if ($this->_resource && $id) {
            $this->_data[$this->_resource->getPrimaryKeyField()] = $id;
        }

    }

    public function load($id)
    {
        $this->_data = $this->_resource->find($id);
    }
}