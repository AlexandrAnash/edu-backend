<?php
namespace Test\Model;

use App\Model\QuoteItem;
//use App\Model\PageNotFoundException;

class QuoteItemTest extends \PHPUnit_Framework_TestCase {

    public function testReturnsIdCustomerWhichHasBeenInitialized()
    {
        $QuoteItem = new QuoteItem(['customer_id' => 111]);
        $this->assertEquals(111, $QuoteItem->getCustomerId());

        $QuoteItem = new QuoteItem(['customer_id' => 222]);
        $this->assertEquals(222, $QuoteItem->getCustomerId());
    }
    public function testReturnsIdProductWhichHasBeenInitialized()
    {
        $QuoteItem = new QuoteItem(['product_id' => 111]);
        $this->assertEquals(111, $QuoteItem->getProductId());

        $QuoteItem = new QuoteItem(['product_id' => 222]);
        $this->assertEquals(222, $QuoteItem->getProductId());
    }

    public function testReturnsCountWhichHasBeenInitialized()
    {
        $QuoteItem = new QuoteItem(['count' => 111]);
        $this->assertEquals(111, $QuoteItem->getCount());

        $QuoteItem = new QuoteItem(['count' => 222]);
        $this->assertEquals(222, $QuoteItem->getCount());
    }

    public function testReturnsIdWhichHasBeenInitialized()
    {
        $QuoteItem = new QuoteItem(['cart_id' => 111]);
        $this->assertEquals(111, $QuoteItem->getId());

        $QuoteItem = new QuoteItem(['cart_id' => 222]);
        $this->assertEquals(222, $QuoteItem->getId());
    }

}
