<?php

namespace App\Model\Quote;


use App\Model\Customer;
use App\Model\Order;
use App\Model\Quote;

class DataConverter
    implements IConverter
{
    private $_prototypeCustomer;
    public function __construct(Customer $prototypeCustomer)
    {
        $this->_prototypeCustomer = $prototypeCustomer;
    }

    public function toOrder(Quote $quote, Order $order)
    {
        date_default_timezone_set('Europe/Moscow');
        if ($quote->getCustomer())
            $this->_prototypeCustomer->load($quote->getCustomer());


        $order->setDataQuoteTotal(
            [
                'customer_name' => $this->_prototypeCustomer->getName(),
                'created_at' => date("Y-m-d H:i:s"),
                'shipping_method' => $quote->getShippingData(),
                'payment_method' => $quote->getPaymentData(),
                'shipping' => $quote->getShipping(),
                'subtotal' => $quote->getSubtotal(),
                'grand_total' => $quote->getGrandTotal()
            ]
        );
    }
}