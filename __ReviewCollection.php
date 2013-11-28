<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 08.11.13
 * Time: 22:42
 */
require_once __DIR__ . '/../src/models/Review.php';
require_once __DIR__ . '/../src/models/ReviewCollection.php';

class ReviewCollectionTest extends PHPUnit_Framework_TestCase {
    public function testRerurnReviewWhichHaveBeenInitializet()
    {
        $reviews = [new Review(['name' => 'aleksandr']), new Review(['name' => 'piter'])];
        $collection = new ReviewCollection($reviews);
        $this->assertEquals($reviews, $collection->getReviews());
    }

    public function testCalculatesCollectionSizeAsReviewCount()
    {
        $reviews = new ReviewCollection([new Review([]), new Review([])]);
        $this->assertEquals(2, $reviews->getSize());

        $reviews = new ReviewCollection([new Review([])]);
        $this->assertEquals(1, $reviews->getSize());
    }

    public function testAppliesLimitToReviewCollectionSize()
    {
        $reviews = new ReviewCollection(
            [new Review(['name' => 'Aleksandr']), new Review(['name' => 'piter']), new Product(['sku' => 'baz'])]
        );
        $reviews->limit(1);
        $this->assertEquals(1, $reviews->getSize());

        $reviews->limit(2);
        $this->assertEquals(2, $reviews->getSize());

        $reviews->limit(4);
        $this->assertEquals(3, $reviews->getSize());
    }

    public function testAppliesLimitToCollectionReviews()
    {
        $reviews = new ReviewCollection(
            [new Review(['name' => 'alexandr']), new Review(['name' => 'piter']), new Review(['name' => 'Dusia'])]
        );
        $reviews->limit(1);
        $this->assertEquals([new Review(['name' => 'alexandr'])], $reviews->getReviews());

        $reviews->limit(2);
        $this->assertEquals([new Review(['name' => 'alexandr']), new Review(['name' => 'piter'])], $reviews->getReviews());
    }

    public function testAppliesOffsetToCollectionReviews()
    {
        $reviews = new ReviewCollection(
            [new Review(['name' => 'alexandr']), new Review(['name' => 'piter']), new Review(['name' => 'Dusia'])]
        );
        $reviews->offset(1);
        $this->assertEquals([new Review(['name' => 'piter']), new Review(['name' => 'Dusia'])], $reviews->getReviews());

        $reviews->offset(2);
        $this->assertEquals([new Review(['name' => 'Dusia'])], $reviews->getReviews());
    }

    public function testReturnsAllReviewsForZeroOffset()
    {
        $reviews = new ReviewCollection(
            [new Review(['name' => 'alexandr']), new Review(['name' => 'piter']), new Review(['name' => 'Dusia'])]
        );
        $reviews->offset(0);
        $this->assertEquals(
            [new Review(['name' => 'alexandr']), new Review(['name' => 'piter']), new Review(['name' => 'Dusia'])],
            $reviews->getReviews()
        );
    }

    public function testAppliesOffsetForReviewsCollectionSize()
    {
        $collection = new ReviewCollection([new Review(['name' => 'alexandr']), new Review(['name' => 'piter']), new Review(['name' => 'Dusia'])]);
        $collection->offset(1);

        $this->assertEquals(2, $collection->getSize());
    }



    public function testIterableWithForeachFunction() {
        $collection = new ReviewCollection([new Review(['name'=>'bar']),
            new Review(['name'=>'foo'])]);
        $expected = array(0=>'bar', 1=>'foo');
        //$this->assertEquals(new Review(['name' => 'foo']), $collection[0]);
        //print_r( $collection->getEntity()[0]->getName());
        //print_r($expected);
        foreach ($collection as $_key => $review) {
            //print_r($_key);
            $this->assertEquals($expected[$_key], $review->getName());
        }
    }
    public function testGetReviewFunction() {
        $collection = new ReviewCollection([new Review(['product' => new Product(['name' => 'sss']),'name' => 'foo', 'text'=>'foooooo']),
            new Review(['product' => new Product(['name' => '123']),'name' => 'bar', 'text'=>'baaar']),
            new Review(['product' => new Product(['name' => 'sss']),'name' => 'bar', 'text'=>'baaar'])]);
        $collection->filterByProduct(new Product(['name' => 'sss']));
    }

    public function testAverageRating()
    {
        $collection = new ReviewCollection([new Review(['product' => new Product(['name' => 'sss']),'name' => 'foo', 'text'=>'foooooo','rating' => 3]),
            new Review(['product' => new Product(['name' => '123']),'name' => 'bar', 'text'=>'baaar', 'rating' => 2]),
            new Review(['product' => new Product(['name' => 'sss']),'name' => 'bar', 'text'=>'baaar','rating' => 5])]);
        $collection->filterByProduct(new Product(['name' => 'sss']));
        $this->assertEquals(4, $collection->getAverageRating());
    }
}
 