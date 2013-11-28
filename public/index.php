<?php

require_once __DIR__ . "/../src/models/Router.php";

if (isset($_GET["page"])) {
    try {
        $router = new Router($_GET["page"]);
    } catch (PageNotFoundException $e) {
        echo $e->getMessage();
        require_once __DIR__ . "/../src/views/error404.phtml";
    }
} else {
    require_once __DIR__ . "/../src/controllers/ProductController.php";
    $controller = new ProductController();
    $controller->listAction();
}
