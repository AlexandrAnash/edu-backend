<?php
namespace Test\Model;

use App\Model\Router;
//use App\Model\PageNotFoundException;

class RouterTest extends \PHPUnit_Framework_TestCase {

    //function testReturnNameController()
    //{
    //    $router = new Router("product_list");
    //    //echo($router->getController());
    //    $this->assertEquals("ProductController", $router->getController());
    //}
//
    //function testReturnNameAction()
    //{
    //    $router = new Router("product_list");
    //    $this->assertEquals("listAction", $router->getAction());
//
    //    $router = new Router("product_List");
    //    $this->assertEquals("listAction", $router->getAction());
    //}

    /**
     * @expectedException App\Model\PageNotFoundException
     * @expectedExceptionMessage In the address bar should be the character '_'.
     */
    function testReturnsPageNotFoundAddressBarNoCharacter()
    {
        new Router('ProductList');
    }

    /**
     * @expectedException App\Model\PageNotFoundException
     * @expectedExceptionMessage In the address bar many the character '_'.
     */
    function testReturnsPageNotFoundAddressBarManyCharacter()
    {
        new Router('Product_List_list');
    }
//
    ///**
    // * @expectedException App\Model\PageNotFoundException
    // * @expectedExceptionMessage Class or method are not exist
    // */
    //function testReturnsPageNotFoundNameController()
    //{
    //    new Router("Groduct_list");
    //}
//
    ///**
    // * @expectedException App\Model\PageNotFoundException
    // * @expectedExceptionMessage Class or method are not exist
    // */
    //function testReturnsPageNotFoundNameAction()
    //{
    //    new Router('product_Mist');
    //}

}
