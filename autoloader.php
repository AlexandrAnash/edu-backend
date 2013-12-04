<?php
require_once __DIR__ . '/vendor/autoload.php';
$loader = new \Zend\Loader\StandardAutoloader;

$loader->registerNamespaces(
    [
        'App\Model' => __DIR__ . '/src/models',
        'App\Controller' => __DIR__ . '/src/controllers'
    ]
);
$loader->register();