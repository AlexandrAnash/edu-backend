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
    private $_di;

    public function __construct(\Zend\Di\Di $di)
    {
        $this->_di = $di;
    }

    public function loginAction()
    {
        if (isset($_POST['customer'])) {
            $login = $this->_loginCustomer();
            if ($login) {
                $customer = $this->_di->get('Customer', ['data' => $login]);

                $session = $this->_di->get('Session');

                $session->login($customer->getId());
                $session->setName($customer->getName());
                $session->setRating($customer->getRating());

                header("Location: /?page=product_list");
            } else {
                return $this->_di->get('View', [
                    'template' => 'customer_login'
                ]);
            }
        } else {
            return $this->_di->get('View', [
                'template' => 'customer_login'
            ]);
        }
    }

    public function logoutAction()
    {
        $session = new Session();
        $session->logout();

        header("Location: /?page=product_list");
    }

    public function registerAction()
    {
        if (isset($_POST['customer'])) {
            $this->_registerCustomer();
            header("Location: /?page=product_list");
        } else {
            return $this->_di->get('View', [
                'template' => 'customer_register'
            ]);
        }
    }

    private function _registerCustomer()
    {
        //var_dump($_POST['customer']);
        //die;
        //$resource = $this->_di->get('ResourceEntity', ['table' => new CustomerTable]);
        $_POST['customer']['password'] = md5($_POST['customer']['password']);
        $customer = $this->_di->get('Customer', ['data' => $_POST['customer']]);
        //var_dump($customer);
        //$customer = new Customer($_POST['customer']);
        //die;
        $customer->save();
    }

    private function _loginCustomer()
    {


        $resource = $this->_di->get('ResourceCollection', ['table' => new CustomerTable]);
        $customers = $this->_di->get('CustomerCollection', ['resource' => $resource]);
        //$customers = new CustomerCollection($resource);
        $_POST['customer']['password'] = md5($_POST['customer']['password']);
        return $customers->getUser($_POST['customer']);
    }

}