<?php
namespace App\Controller;

use App\Model\CustomerCollection;
use App\Model\Resource\DBCollection;
use App\Model\Resource\DBEntity;
//use App\Model\CustomerCollection;
use App\Model\Customer;
use App\Model\Resource\Table\Review as ReviewTable;
use App\Model\ReviewCollection;
use App\Model\Resource\Table\Customer as CustomerTable;
use App\Model\Session;

class CustomerController
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

    public function loginAction()
    {
        if (isset($_POST['customer'])) {
            $login = $this->_loginCustomer();
            if ($login)
            {
                var_dump($login);
                $customer = new Customer($login);
                $session = new Session();
                $session->login($customer->getId());
                $session->getName($customer->getName());
                $session->getRating($customer->getRating());
                //$session->getCustomers($customer);

                $cont = new ProductController();
                $cont->listAction();
            } else
            {
                $view = 'customer_login';
                require_once __DIR__ . "/../views/layout/base.phtml";
            }
        } else {
            $view = 'customer_login';
            require_once __DIR__ . "/../views/layout/base.phtml";
        }
    }

    public function logoutAction()
    {
        $session = new Session();
        $session->logout();

        $cont = new ProductController();
        $cont->listAction();
    }

    public function registerAction()
    {
        if (isset($_POST['customer'])) {
            $this->_registerCustomer();
        } else {
            $view = 'customer_register';
            require_once __DIR__ . "/../views/layout/base.phtml";
        }
    }

    private function _registerCustomer()
    {
        $resource = new DBEntity($this->_conn, new CustomerTable);
        $_POST['customer']['password'] = md5($_POST['customer']['password']);
        $customer = new Customer($_POST['customer']);
        $customer->save($resource);
    }

    private function _loginCustomer()
    {
        $resource = new DBCollection($this->_conn, new CustomerTable);
        $customers = new CustomerCollection($resource);
        $_POST['customer']['password'] = md5($_POST['customer']['password']);
        return $customers->getUser($_POST['customer']);
    }

}