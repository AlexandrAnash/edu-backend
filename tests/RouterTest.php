<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10.11.13
 * Time: 13:58
 */
require_once __DIR__ . "/../src/models/Router.php";
class RouterTest extends PHPUnit_Framework_TestCase {

    function testReturnNameController()
    {
        $router = new Router("product_list");
        //echo($router->getController());
        $this->assertEquals("ProductController", $router->getController());
    }

    function testRrurnNameAction()
    {
        $router = new Router("product_list");
        $this->assertEquals("listAction", $router->getAction());

        $router = new Router("product_List");
        $this->assertEquals("listAction", $router->getAction());
    }

}
 