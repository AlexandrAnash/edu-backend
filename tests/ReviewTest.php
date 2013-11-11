<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 08.11.13
 * Time: 22:05
 */
require_once __DIR__ . '/../src/models/Review.php';
class ReviewTest extends PHPUnit_Framework_TestCase {
    public function testReturnsBelongsToProduct()
    {
        $review = new Review(['product' => new Product(['sku'=>'123456'])]);
        $this->assertEquals(true, $review->belongsToProduct(new Product(['sku'=>'123456'])));

        $review = new Review(['product' => new Product(['sku'=>'555551'])]);
        $this->assertEquals(true, $review->belongsToProduct(new Product(['sku'=>'555551'])));
    }

    public function testReturnsNameWhichHasBeenInitialized()
    {
        $review = new Review(['name' => 'Aleksandr']);
        $this->assertEquals('Aleksandr', $review->getName());

        $review = new Review(['name' => 'Pod']);
        $this->assertEquals('Pod', $review->getName());
    }
//
    public function testReturnsEmailWhichHasBeenInitialized()
    {
        $review = new Review(['email' => 'alexanash92@gmail.com']);
        $this->assertEquals('alexanash92@gmail.com', $review->getEmail());
//
        $review = new Review(['email' => 'Pod@pot.got']);
        $this->assertEquals('Pod@pot.got', $review->getEmail());
    }
//
    public function testReturnsTextWhichHasBeenInitialized()
    {
        $review = new Review(['text' => 'TextTextTetxTextTextTetxTextTextTetx']);
        $this->assertEquals('TextTextTetxTextTextTetxTextTextTetx', $review->getText());
//
        $review = new Review(['text' => 'TextTextTextTetx']);
        $this->assertEquals('TextTextTextTetx', $review->getText());
    }
    public function testReturnsSpecialPriceWhichHasBeenInitialized()
    {
        $review = new Review(['rating' => 5]);
        $this->assertEquals(5, $review->getRating());
//
        $review = new Review(['rating' => 3]);
        $this->assertEquals(3, $review->getRating());
    }
}
 