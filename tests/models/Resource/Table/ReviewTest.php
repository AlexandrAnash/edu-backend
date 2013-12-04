<?php

namespace Test\Model\Resource\Table;


use App\Model\Resource\Table\Review;

class ReviewTest extends \PHPUnit_Framework_TestCase {
    public function testReturnReviewTableName()
    {
        $review = new Review();
        $this->assertEquals('reviews', $review->getName());
    }

    public function testReturnReviewPrimaryKey()
    {
        $review = new Review();
        $this->assertEquals('review_id', $review->getPrimaryKey());

    }

} 