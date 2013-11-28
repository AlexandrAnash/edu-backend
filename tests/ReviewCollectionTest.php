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

    public function testFilterByProduct()
    {
        $productNokla = new Product(['name' => 'Nokla']);
        $productMotorobla = new Product(['name' => 'Motorobla']);

        $resourceReview = $this->getMock('IResourceCollection');
        $resourceReview->expects($this->any())
            ->method('fetch')
            ->will($this->returnValue(
                [
                    ['product' => $productMotorobla],
                    ['product' => $productNokla],
                    ['product' => $productNokla],
                    ['product' => $productNokla]
                ]
            ));
        $collectionReview = new ReviewCollection($resourceReview);
        $collectionReview->filterByProduct($productMotorobla);
        //print_r([new Review(['product' => $productMotorobla])]);
        //print_r($collectionReview->getReviews());
        $this->assertEquals([new Review(['product' => $productMotorobla])], $collectionReview->getReviews());
    }


}
 