<?php
require_once __DIR__ . '/../models/Product.php';
require_once __DIR__ . '/../models/ProductCollection.php';
require_once __DIR__ . '/../models/ReviewCollection.php';
require_once __DIR__ . '/../models/Resource/DBCollection.php';
require_once __DIR__ . '/../models/Resource/DBEntity.php';

class ProductController
{
    private $_conn;

    public function __construct()
    {
        try {
            $this->_conn = new PDO('mysql:host=localhost;dbname=shop', 'root', '123');
            $this->_conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    public function listAction()
    {

        $resourceProduct = new DBCollection($this->_conn, 'products');
        $products = new ProductCollection($resourceProduct);

        require_once __DIR__ . "/../views/product_list.phtml";
    }

    public function viewAction()
    {
        $product = new Product([]);

        $resource = new DBEntity($this->_conn, 'products', 'product_id');
        $product->load($resource, $_GET['id']);

        $resourceReview = new DBCollection($this->_conn, 'reviews');
        $reviewsAll = new ReviewCollection($resourceReview);
        $reviewsAll->filterByProduct($product);

        require_once __DIR__ . "/../views/product_view.phtml";
    }

}