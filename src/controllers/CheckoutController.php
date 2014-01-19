<?php
namespace App\Controller;

use App\Model\QuoteCollection;
use Zend\Mail\Transport\Smtp as SmtpTransport;
use Zend\Mail\Transport\SmtpOptions;

class CheckoutController
    extends SalesController
{
    public function addressAction()
    {
        if (isset($_POST['address'])) {
            $quote = $this->_initQuote();
            $address = $quote->getAddress();
            $address->setData($_POST['address']);
            $address->save();
            $this->_redirect('checkout_shipping');
        } else {
            $city = $this->_di->get('City');
            $cityResource = $this->_di->get('ResourceCollection', ['table' => new \App\Model\Resource\Table\City]);
            $cityCollection = $this->_di->get('CityCollection', ['resource' => $cityResource, 'cityPrototype' => $city]);

            $region = $this->_di->get('Region');
            $regionResource = $this->_di->get('ResourceCollection', ['table' => new \App\Model\Resource\Table\Region]);
            $regionCollection = $this->_di->get('RegionCollection', ['resource' => $regionResource, 'regionPrototype' => $region]);

            return $this->_di->get('View', [
                'template' => 'checkout_address',
                'params' => [
                    'cities' => $cityCollection->getCities(),
                    'regions' => $regionCollection->getRegions(),
                    'view' => 'checkout_address'
                ]
            ]);
        }
    }

    public function shippingAction()
    {
        $quote = $this->_initQuote();
        if (isset($_POST['method'])) {
            $quote->setShippingData($_POST['method']);
            $this->_redirect('checkout_payment');
        } else {
            $address = $quote->getAddress();
            $factory = $this->_di->get('ShippingFactory', ['address' => $address]);
            $methods = $factory->getMethods();

            $methodsArray = [];
            foreach ($methods as $method) {
                $methodsArray[] = [
                    'code' => $method->getCode(),
                    'price' => $method->getPrice(),
                    'label' => $method->getLabel()];
            }

            return $this->_di->get('View', [
                'template' => 'checkout_shipping',
                'params' => ['methods' => $methodsArray]
            ]);
        }
    }

    public function paymentAction()
    {
        $quote = $this->_initQuote();
        if (isset($_POST['method'])) {
            $quote->setPaymentData($_POST['method']);
            $this->_redirect('checkout_order');
        } else {
            $methods = $this->_di->get('PaymentFactory')
                ->getMethods()
                ->available($quote->getAddress());
            return $this->_di->get('View', [
                'template' => 'checkout_payment',
                'params' => ['methods' => $methods]
            ]);
        }
    }

    public function orderAction()
    {
        $quote = $this->_initQuote();
        $quote->collectTotals();
        $quote->save();
        if ($this->_isPost()) {
            $order = $this->_di->get('Order');
            $this->_di->get('QuoteConverter')
                ->toOrder($quote, $order);
            //die;
            $order->save();
            $order->sendEmail();
            $order->save();
        } else {
            return $this->_di->get('View', [
                'template' => 'checkout_order',
                'params' => [
                    'subtotal' => $quote->getSubtotal(),
                    'shipping' => $quote->getShipping(),
                    'grand_total' => $quote->getGrandTotal()
                ]
            ]);

        }
    }

}