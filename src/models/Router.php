<?php
ini_set('display_errors', 1);
require_once __DIR__ . '/PageNotFoundException.php';
class Router
{
    private $_controller;
    private $_action;

    public function __construct($getPage)
    {

        if (!stristr($getPage, '_'))
            throw new PageNotFoundException("In the address bar should be the character '_'.");

        if (count(explode('_', $getPage)) > 2)
            throw new PageNotFoundException("In the address bar many the character '_'.");

        list($this->_controller, $this->_action) = explode('_', $getPage);

        $controllerName = $this->getController();
        $actionName = $this->getAction();
        $path = __DIR__ . "/../controllers/{$controllerName}.php";
        if (file_exists($path)) {
            require_once $path;
            $controller = new $controllerName;
            if (method_exists($controller, $actionName))
                $controller->$actionName();
            else
                throw new PageNotFoundException("The wrong address!");
        } else
            throw new PageNotFoundException("The wrong address!");
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