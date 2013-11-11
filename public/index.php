<?php

require_once __DIR__ . "/../src/models/Router.php";

if (isset($_GET["page"])) {
    @$router = new Router($_GET["page"]);
    $controllerName = $router->getController();
    $actionName = $router->getAction();
    $path = __DIR__ . "/../src/controllers/{$controllerName}.php";
    if (file_exists(__DIR__ . "/../src/controllers/{$controllerName}.php")) {
        require_once $path;
        $controller = new $controllerName;
        if (method_exists($controller, $actionName))
            $controller->$actionName();
        else
            require_once __DIR__ . "/../src/views/error404.phtml";
    } else
        require_once __DIR__ . "/../src/views/error404.phtml";


} else {
    require_once __DIR__ . "/../src/controllers/ProductController.php";
    $controller = new ProductController();
    $controller->listAction();
}

