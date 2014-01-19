<?php
namespace App\Controller;

use App\Model\Session;
use App\Model\Resource\Table\Customer as CustomerTable;

class SalesController
    extends ActionController
{
    protected function _initQuote($collectorFactory = null)
    {
        $quote   = $this->_di->get('Quote', ['collectorsFactory' => $collectorFactory]);
        $session = $this->_di->get('Session');
        $customer = $this->_di->get('Customer');


        if ($session->isLoggedIn())
        {
            $customer->load($session->getCustomer());
            $quote->loadByCustomers($customer);
            $session->setQuoteId($customer->getQuoteId());
        }
        $quote->loadBySession($session);
        return $quote;
    }
   //protected function _initQuote()
   //{
   //    $quote = $this->_di->get('Quote');
   //    $session = new Session; // get session
   //    if ($session->isLoggedIn()) {
   //        $quote->loadByCustomer($session->getCustomer());
   //        return $quote;
   //    } else {
   //        $quote->loadBySession($session->getSessionId());
   //        return $quote;
   //    }
   //}
}