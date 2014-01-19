<?php
namespace Test\Model;

use App\Model\Product;
use App\Model\Quote;
use App\Model\QuoteItem;
//use App\Model\PageNotFoundException;

class QuoteTest extends \PHPUnit_Framework_TestCase {

    public function testQuoteLoadByCustomer()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['customer_id' => 10, 'product_id' => 12],
                    ['customer_id' => 11, 'product_id' => 12],
                ]
            ));

        $quote = new Quote($resource);
        $quote->loadByCustomer(11);

    }

    public function testQuoteLoadBySession()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['customer_id' => 10, 'product_id' => 12],
                    ['customer_id' => 11, 'product_id' => 12],
                ]
            ));
        $quote = new Quote($resource);
        $quote->loadBySession(11);
    }

    public function testReturnQuoteItemForProduct()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['customer_id' => 11, 'product_id' => 12],
                ]
            ));
        $product = new Product([
            'product_id' => 12,
            'name' => 'Product'
        ]);
        $expected =['customer_id' => 11, 'product_id' => 12];
        $quote = new Quote($resource);
        $quote->loadByCustomer(11);
        $this->assertEquals( $expected,$quote->getItemForProduct($product));
    }

    public function testReturnQuoteAddQty()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    [],
                ]
            ));
        $product = new Product([
            'product_id' => 12,
            'name' => 'Product'
        ]);
        $expected = new QuoteItem(['customer_id' => 11, 'product_id' => 12, 'count' => 1]);
        $quote = new Quote($resource);
        $quote->loadByCustomer(11);
        $quote->getItemForProduct($product);

        $this->assertEquals( $expected,$quote->addQty());
    }

    public function testReturnQuoteUpdateQty()
    {
        $resource = $this->getMock('\App\Model\Resource\IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['customer_id' => 11, 'product_id' => 12, 'count' => 10],
                ]
            ));
        $product = new Product([
            'product_id' => 12,
            'name' => 'Product'
        ]);
        $expected = new QuoteItem(['customer_id' => 11, 'product_id' => 12, 'count' => 11]);
        $quote = new Quote($resource);
        $quote->loadByCustomer(11);
        $quote->getItemForProduct($product);
        $this->assertEquals( $expected,$quote->updateQty());
    }

    //public function testReturnsAssginedAddress()
    //{
    //    $address = $this->getMock('Add\Model\Address', ['load']);
    //    $address->expects($this->once())
    //        ->method('load')
    //        ->with($this->equalTo(42));
    //    $quote = new Quote(['addres_id' => 42], null, null, $address);
//
    //    $quote->getAddress();
//
    //}
//
//
    //public function testCreatesNewAddressIfNotAssigned()
    //{
    //    $address = $this->getMock('Add\Model\Address', ['getId', 'save']);
    //    $address->expects($this->once())
    //        ->method('save');
    //    $address->expects($this->once())
    //        ->method('getId')
    //        ->will($this->returnValue(42));
    //    $quoteResource = $this->getMock('App\Model\Resource\IResourceEntity');
    //    $quote = new Quote(['addres_id' => 42], null, null, $address);
    //    $quote = $this->getMock('App\Model\Quote', array('save'), array([], null, null, $address));
//
    //    $this->getAddress();
//
    //    $this->assertEquals(42, $quote->getAddressId());
    //}



}
