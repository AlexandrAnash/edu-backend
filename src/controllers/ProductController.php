<?php
namespace App\Controller;

use App\Model\Resource\DBCollection;
use App\Model\Resource\DBEntity;
use App\Model\ProductCollection;
use App\Model\Product;
use App\Model\Resource\Table\Review as ReviewTable;
use App\Model\ReviewCollection;
use App\Model\Resource\Table\Product as ProductTable;

class ProductController
{
    private $_conn;

    public function __construct()
    {
        try {
            $this->_conn = new \PDO('mysql:host=localhost;dbname=shop', 'root', '123');
            $this->_conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            echo 'ERROR: ' . $e->getMessage();
        }
    }

    public function listAction()
    {

        $resourceProduct = new DBCollection($this->_conn, new ProductTable);
        $products = new ProductCollection($resourceProduct);

        require_once __DIR__ . "/../views/product_list.phtml";
    }

    public function viewAction()
    {
        $product = new Product([]);

        $resource = new DBEntity($this->_conn, new ProductTable);
        $product->load($resource, $_GET['id']);

        $resourceReview = new DBCollection($this->_conn, new ReviewTable);
        $reviewsAll = new ReviewCollection($resourceReview);
        $reviewsAll->filterByProduct($product);

        require_once __DIR__ . "/../views/product_view.phtml";
    }

}