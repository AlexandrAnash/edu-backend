<?php

namespace App;

require_once __DIR__ . '/../autoloader.php';
ini_set('display_errors', 1);
try {
    $defaultPath = 'product_list';

    $routePath = isset($_GET["page"]) ? $_GET["page"] : $defaultPath;

    $router = new Model\Router($routePath);
    $controllerName = $router->getController();
    $actionName = $router->getAction();
    if (!class_exists($controllerName) || !method_exists($controllerName, $actionName)) {
        var_dump($controllerName);
        throw new Model\PageNotFoundException("Class or method are not exist");
    }

} catch (Model\PageNotFoundException $e) {
    $controllerName = '\App\Controller\ErrorController';
    $actionName = 'notFoundAction';
}
$controller = new $controllerName;
$controller->$actionName();
