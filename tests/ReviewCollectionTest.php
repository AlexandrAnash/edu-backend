<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 08.11.13
 * Time: 22:42
 */
require_once __DIR__ . '/../src/models/Review.php';
require_once __DIR__ . '/../src/models/ReviewCollection.php';
require_once __DIR__ . '/../src/models/ProductCollection.php';
require_once __DIR__ . '/../src/models/Product.php';

class ReviewCollectionTest extends PHPUnit_Framework_TestCase {
    public function testTakesDataFromResourceReview()
    {
        $resource = $this->getMock('IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['name' => 'aleksandr']
                ]
            ));

        $collection = new ReviewCollection($resource);
        $review = $collection->getReviews();
        $this->assertEquals('aleksandr', $review[0]->getName());
    }

   //public function testTakesDataFromResourceReviewByFilter()
   //{
   //    $product = new Product(['product_id' => 1]);
   //    $resource = $this->getMock('IResourceCollection');
   //    $resource->expects($this->any())
   //        ->method('whereProduct')
   //        ->will($this->returnValue(
   //            [
   //                ['id' => 1, 'name' => 'aleksandr'],
   //                ['id' => 2, 'name' => 'foo'],
   //                ['id' => 3, 'name' => 'bar']
   //            ]
   //        ));
//
   //    $collection = new ReviewCollection($resource);
   //    $collection->filterByProduct($product);
   //    $review = $collection->getReviews();
   //    //var_dump($review);
   //    $this->assertEquals([['id' => 1, 'name' => 'aleksandr']], $review);
   //}

    public function testInIterableWithForeachFunctionReviews()
    {
        $resource = $this->getMock('IResourceCollection');
        $resource->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
            [
                ['name' => 'aleksandr'],
                ['name' => 'Jon']
            ]
            ));
        $collection = new ReviewCollection($resource);
        $expected = array(0 => 'aleksandr', 1 => 'Jon');
        //print_r($collection);
        foreach ($collection as $_key => $_review) {
            $this->assertEquals($expected[$_key], $_review->getName());
        }

    }

    public function testLoadsDataFromResource()
    {
        $resource = $this->getMock('IResourceEntity');
        $resource->expects($this->any())
            ->method('find')
            ->with($this->equalTo(42))
            ->will($this->returnValue(['name' => 'Vasia']));

        $review = new Review([]);
        $review->load($resource, 42);

        $this->assertEquals('Vasia', $review->getName());
    }

    /**
     * @dataProvider getProductIds
     */
    public function testFiltersCollectionByProduct($productId)
    {
        $product = new Product(['product_id' => $productId]);
        $resource = $this->getMock('IResourceCollection');
        $resource->expects($this->any())
            ->method('filterBy')
            ->with($this->equalTo('product_id'), $this->equalTo($productId));
//
        $collection = new ReviewCollection($resource);
//
        $collection->filterByProduct($product);
    }
//
    public function getProductIds()
    {
        return [[1], [2]];
    }

    public function testCalcAverageRation()
    {
        $resource = $this->getMock('IResourceCollection');
        $resource->expects($this->any())
            ->method('Average')
            ->with($this->equalTo('rating'));

        $collection = new ReviewCollection($resource);

        $collection->getAverageRating();
    }

}
 