<?php
ini_set('display_errors', 1);
class Router
{
    private $_controller;
    private $_action;

    public function __construct($getPage)
    {
        try {
            if (!stristr($getPage, '_'))
                throw new Exception("In the address bar should be the character '_'.");
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
                    throw new Exception("The wrong address!");
            } else
                throw new Exception("The wrong address!");

        } catch (Exception $e) {
            echo $e->getMessage();
            require_once __DIR__ . "/../views/error404.phtml";

        }
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