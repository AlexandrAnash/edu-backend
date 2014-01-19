<?php
namespace App\Controller;

use App\Model\Admin;
use App\Model\CustomerCollection;
use App\Model\Resource\DBCollection;
use App\Model\Resource\DBEntity;
//use App\Model\CustomerCollection;
use App\Model\Customer;
use App\Model\Resource\Table\Order;
use App\Model\Resource\Table\Review as ReviewTable;
use App\Model\ReviewCollection;
use App\Model\Resource\Table\Admin as AdminTable;
use App\Model\Session;

class AdminController
{
    private $_di;

    public function __construct(\Zend\Di\Di $di)
    {
        $this->_di = $di;
    }

    public function loginAction()
    {
        if (isset($_POST['admin'])) {
            $login = $this->_loginAdmin();
            if ($login) {
                $admin = $this->_di->get('Admin', ['data' => $login]);

                $session = $this->_di->get('Session');
                $session->loginAdmin($admin->getId());
                $session->setName($admin->getName());
                header("Location: /?page=product_list");
            } else {
                return $this->_di->get('View', [
                    'template' => 'admin_login'
                ]);
            }
        } else {
            return $this->_di->get('View', [
                'template' => 'admin_login'
            ]);
        }
    }

    public function logoutAction()
    {
        $session = $this->_di->get('Session');
        $session->logoutAdmin();
        header("Location: /?page=product_list");
    }

    public function registerAction()
    {
        if (isset($_POST['admin'])) {
            $this->_registerAdmin();
            header("Location: /?page=product_list");
        } else {
            return $this->_di->get('View', [
                'template' => 'admin_register'
            ]);
        }
    }

    public function OrdersAction()
    {
        $resource = $this->_di->get('ResourceCollection', ['table' => new Order()]);
        $orders = $this->_di->get('OrderCollection', ['collection' => $resource]);

        $filterKey = isset($_POST['filter']['key']) ? $_POST['filter']['key'] : null;
        $filterValue = isset($_POST['filter']['value']) ? $_POST['filter']['value']  : null;

        if ($filterKey != "" && $filterValue != "")
            $orders->filterLikeByOrder($filterKey,$filterValue);
        $order = [];
        $volume = [];
        foreach ($orders->getItems() as $item)
        {
            $order[] = [
                'number_order'  => $item->getNumber(),
                'created_at'    => $item->getDate(),
                'grand_total'   => $item->getGrandTotal(),
                'status'        => $item->getStatus()
            ];
            $volume[] = $item->getGrandTotal();
        }
        //array_multisort($volume, SORT_DESC, $order);
        return $this->_di->get('View', [
            'template' => 'admin_orders',
            'params' => ['orders' => $order]
        ]);
    }

    private function _registerAdmin()
    {
        $_POST['admin']['password'] = md5($_POST['admin']['password']);
        $admin = $this->_di->get('Admin', ['data' => $_POST['admin']]);
        $admin->save();
    }

    private function _loginAdmin()
    {
        $resource = $this->_di->get('ResourceCollection', ['table' => new AdminTable]);
        $admins = $this->_di->get('AdminCollection', ['resource' => $resource]);
        $_POST['admin']['password'] = md5($_POST['admin']['password']);
        return $admins->getUser($_POST['admin']);
    }

}