<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 10.11.13
 * Time: 13:58
 */
require_once __DIR__ . "/../src/models/Router.php";
require_once __DIR__ . "/../src/models/PageNotFoundException.php";
class RouterTest extends PHPUnit_Framework_TestCase {

    function testReturnNameController()
    {
        $router = new Router("product_list");
        //echo($router->getController());
        $this->assertEquals("ProductController", $router->getController());
    }

    function testReturnNameAction()
    {
        $router = new Router("product_list");
        $this->assertEquals("listAction", $router->getAction());

        $router = new Router("product_List");
        $this->assertEquals("listAction", $router->getAction());
    }

    /**
     * @expectedException PageNotFoundException
     * @expectedExceptionMessage In the address bar should be the character '_'.
     */
    function testReturnsPageNotFoundAddressBarNoCharacter()
    {
        new Router('ProductList');
    }

    /**
     * @expectedException PageNotFoundException
     * @expectedExceptionMessage In the address bar many the character '_'.
     */
    function testReturnsPageNotFoundAddressBarManyCharacter()
    {
        new Router('Product_List_list');
    }

    /**
     * @expectedException PageNotFoundException
     * @expectedExceptionMessage The wrong address!
     */
    function testReturnsPageNotFoundNameController()
    {
        new Router('Groduct_list');
    }

    /**
     * @expectedException PageNotFoundException
     * @expectedExceptionMessage The wrong address!
     */
    function testReturnsPageNotFoundNameAction()
    {
        new Router('product_Mist');
    }

}
 