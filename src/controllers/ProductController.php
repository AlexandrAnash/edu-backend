<?php
namespace App\Controller;

use App\Model\Resource\DBCollection;
use App\Model\Resource\DBEntity;
use App\Model\ProductCollection;
use App\Model\Product;
use App\Model\Resource\Table\Review as ReviewTable;
use App\Model\Resource\Paginator as PaginatorAdapter;
use Zend\Paginator\Paginator as ZendPaginator;
use App\Model\ReviewCollection;
use App\Model\Resource\Table\Product as ProductTable;

class ProductController
{
    private $_conn;
    private $_di;

    public function __construct(\Zend\Di\Di $di)
    {
        $this->_di = $di;

        //try {
        //    $this->_conn = new \PDO('mysql:host=localhost;dbname=shop', 'root', '123');
        //    $this->_conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        //} catch (\PDOException $e) {
        //    echo 'ERROR: ' . $e->getMessage();
        //}
    }

    public function listAction()
    {

        $resource = $this->_di->get('ResourceCollection', ['table' => new ProductTable]);
        $paginator = $this->_di->get('Paginator', ['collection' => $resource]);

        $paginator
            ->setItemCountPerPage(2)
            ->setCurrentPageNumber(isset($_GET['p']) ? $_GET['p'] : 1);
        $pages = $paginator->getPages();
        $products = $this->_di->get('ProductCollection', ['resource' => $resource]);
        return $this->_di->get('View', [
            'template' => 'product_list',
            'params'   => ['products' => $products, 'pages' => $pages]
        ]);
    }

    public function viewAction()
    {
        $product = $this->_di->get('Product');
        $product->load($_GET['id']);
        $resourceReview = $this->_di->get('ResourceCollection', ['table' => new ReviewTable]);
        $reviews = $this->_di->get('ReviewCollection', ['resource' => $resourceReview]);
        $reviews->filterByProduct($product);
        $paginator = $this->_di->get('Paginator', ['collection' => $resourceReview]);
        $paginator
            ->setItemCountPerPage(2)
            ->setCurrentPageNumber(isset($_GET['p']) ? $_GET['p'] : 1);
        $pages = $paginator->getPages();
        return $this->_di->get('View', [
            'template' => 'product_view',
            'params'   => ['product' => $product, 'reviews' => $reviews, 'pages' => $pages]
        ]);
    }

}