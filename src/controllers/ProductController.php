<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/ProductCollection.php';
require_once __DIR__ . '/../models/ReviewCollection.php';
require_once __DIR__ . '/../models/Resource/DBCollection.php';
require_once __DIR__ . '/../models/Resource/DBEntity.php';

class ProductController
{
    public function listAction()
    {

        $connection = new PDO('mysql:host=localhost;dbname=shop', 'root', '123');
        $resourceProduct = new DBCollection($connection, 'products');
        $products = new ProductCollection($resourceProduct);

        require_once __DIR__ . "/../views/product_list.phtml";
    }

    public function viewAction()
    {
        $product = new Product([]);

        $connection = new PDO('mysql:host=localhost;dbname=shop', 'root', '123');
        $resource = new DBEntity($connection, 'products', 'product_id');
        $product->load($resource, $_GET['id']);

        //$resource = new DBEntity($connection, 'review', 'product_id');
        //$product->load($resource, $_GET['id']);

        $resourceReview = new DBCollection($connection, 'reviews');
        $reviewsAll = new ReviewCollection($resourceReview);
        $reviewsAll->filterByProduct($product);

        require_once __DIR__ . "/../views/product_view.phtml";
    }

}