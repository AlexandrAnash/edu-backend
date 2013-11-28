<?php
require_once __DIR__ . '/../src/models/Product.php';
require_once __DIR__ . '/../src/models/Resource/IResourceEntity.php';

class ProductTest extends PHPUnit_Framework_TestCase
{
   public  function testReturnsIdWhichHasBeenInitialized()
   {
       $product = new Product(['product_id'=>1]);
       $this -> assertEquals(1, $product->getProductId());

       $product = new Product(['product_id' => 2]);
       $this->assertEquals(2, $product->getProductId());
   }

    public function testLoadsDataFromResource()
    {
        $resource = $this->getMock('IResourceEntity');
        $resource->expects($this->any())
            ->method('find')
            ->with($this->equalTo(42))
            ->will($this->returnValue(['name' => 'foo']));

        $product = new Product([]);
        $product->load($resource, 42);

        $this->assertEquals('foo', $product->getName());
    }
}