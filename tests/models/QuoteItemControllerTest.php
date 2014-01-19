<?php
namespace Test\Model;

use \App\Model\ProductCollection;
use App\Model\QuoteItemCollection;

class QuoteItemCollectionTest extends \PHPUnit_Framework_TestCase
{

    //public function testTakesDataFromResourceProduct()
    //{
    //    $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
    //    $resource->expects($this->any())
    //        ->method('fetch')
    //        ->will($this->returnValue(
    //            [
    //                ['customer_id' => 10, 'product_id' => 12],
    //                ['customer_id' => 11, 'product_id' => 12],
    //            ]
    //        ));
//
    //    $collection = new QuoteItemCollection($resource);
    //    $collection->filterByQuote();
    //    $quote = $collection->getQuote();
    //    $this->assertEquals('11', $quote[1]->getCustomerId());
    //}

   // public function testIsIterableWithForeachFunction()
   // {
   //     $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
   //     $resource->expects($this->any())
   //         ->method('fetch')
   //         ->will($this->returnValue(
   //             [
   //                 ['sku' => 'foo'],
   //                 ['sku' => 'bar']
   //             ]
   //         ));
//
   //     $collection = new ProductCollection($resource);
   //     $expected = array(0 => 'foo', 1 => 'bar');
   //     $iterated = false;
   //     foreach ($collection as $_key => $_product) {
   //         $this->assertEquals($expected[$_key], $_product->getSku());
   //     }
   // }




}