<?php
ini_set('display_errors', 1);
class Router
{
    private $_controller;
    private $_action;

    public function __construct($getPage)
    {
        list($this->_controller, $this->_action) = explode('_',$getPage);
    }

    public function getController()
    {
        return ucfirst($this->_controller) . "Controller";
    }

    public function getAction()
    {
        return lcfirst($this->_action) . "Action";
    }


}