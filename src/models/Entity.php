<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 08.11.13
 * Time: 15:39
 */

class Entity {

    private $_data = array();

    public function __construct(array $data)
    {
        $this->_data = $data;
    }

    protected function _getData($key)
    {
        return isset($this->_data[$key]) ? $this->_data[$key] : null;
    }
}