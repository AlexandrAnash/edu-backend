<?php

namespace App\Model\Quote;


use App\Model\Quote;
use App\Model\Shipping\Factory;

class ShippingCollector
    implements ICollector
{

    public function collect(Quote $quote)
    {

        $method = $quote->getShippingData();
        $factory = new Factory($quote->getAddress());
        return $factory->getMethodByCode($method)
                       ->getPrice();


    }
}