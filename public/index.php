<?php

require_once __DIR__ . "/../src/models/Router.php";

if (isset($_GET["page"])) {
    $router = new Router($_GET["page"]);
} else {
    require_once __DIR__ . "/../src/controllers/ProductController.php";
    $controller = new ProductController();
    $controller->listAction();
}

