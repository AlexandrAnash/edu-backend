<?php

class EntityCollection
    implements IteratorAggregate
{
    public $_collection;

    public $_offset;
    public $_limit;
    private $_sortField;

    public function __construct($obj)
    {
        $this->_collection = $obj;
    }

    public function getIterator()
    {
        return new ArrayIterator($this->getEntity());
    }

    public function getEntity()
    {
        $entities = array_slice($this->_collection, $this->_offset, $this->_limit);
        return $this->_sortEntities($entities);
    }

    public function getSize()
    {
        return count($this->getEntity());
    }

    public function limit($limit)
    {
        $this->_limit = $limit;
    }

    public function offset($offset)
    {
        $this->_offset = $offset;
    }

    public function sort($field) {
        $this->_sortField = $field;
    }

    private function _sortEntities($entities)
    {
        if (!$this->_sortField) {
            return $entities;
        }

        usort($entities, function (Entity $first, Entity $second) {
            return $first->getData($this->_sortField) > $second->getData($this->_sortField);
        });
        return $entities;
    }
} 