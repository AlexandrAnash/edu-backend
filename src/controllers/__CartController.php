<?php
namespace App\Controller;

use App\Model\ProductCollection;
use App\Model\Resource\DBCollection;
use App\Model\Resource\DBEntity;
use App\Model\CartCollection;
use App\Model\Cart;
use App\Model\Resource\Table\Cart as CartTable;
use App\Model\Resource\Table\Product as ProductTable;
use App\Model\Session;
use App\Model\Product;

class CartController
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

    public function addAction()
    {
        $session = new Session();
        $resourceEntity = new DBEntity($this->_conn, new CartTable);
        $cartData = $this->_getCartData();
        $idCustomer = $session->getSessionUser();
        $count = $this->_getCount();

        if (!$cartData) {
            $cart = new Cart([
                'count' => $count,
                'product_id' => $_POST['cart']['product_id'],
                'customer_id' => $idCustomer
            ]);
            $cart->save($resourceEntity);
        } else {
            $cartData['count'] += $count;
            $resourceEntity->save($cartData);
        }

        header("Location: /?page=product_list");
    }

    public function listAction()
    {
        $session = new Session();
        $resourceEntity = new DBEntity($this->_conn, new ProductTable);
        $resourceEntities = new DBCollection($this->_conn, new CartTable);

        $idCustomer = $session->getSessionUser();

        $carts = new CartCollection($resourceEntities);
        $carts = $carts->getItemCarts($idCustomer);

        $products = array_map(function ($cart) use ($resourceEntity) {
            return new Product($resourceEntity->find($cart['product_id']));
        }, $carts);


        $view = 'cart_list';
        require_once __DIR__ . "/../views/layout/base.phtml";
  }

    public function deleteAction()
    {
        $resourceEntity = new DBEntity($this->_conn, new CartTable);

        $count = $this->_getCount();
        $cartData = $this->_getCartData();

        if ($cartData['count'] > $count)
        {
            $cartData['count'] -= $count;
            $resourceEntity->save($cartData);
        } else
        {
            $resourceEntity->remove($cartData['cart_id']);
        }
        header("Location: /?page=cart_list");
    }

    private function _getCartData()
    {
        $session = new Session();
        $resourceEntities = new DBCollection($this->_conn, new CartTable);

        $idCustomer = $session->getSessionUser();
        $resourceEntities->filterBy('customer_id', $idCustomer);
        $resourceEntities->filterBy('product_id', $_POST['cart']['product_id']);
        return reset($resourceEntities->fetch());
    }

    private function _getCount()
    {

        if (isset($_POST['cart']['count']) && $_POST['cart']['count'] > 0)
            return $_POST['cart']['count'];
        return 0;
    }


}