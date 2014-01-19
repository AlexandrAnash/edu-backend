<?php

namespace App\Model\Quote;


use App\Model\City;
use App\Model\Order;
use App\Model\Quote;
use App\Model\Region;

class AddressConverter
    implements IConverter
{
    private $_city;
    private $_region;

    public function __construct(City $city, Region $region)
    {
        $this->_city = $city;
        $this->_region = $region;
    }

    public function toOrder(Quote $quote, Order $order)
    {
        $address = $quote->getAddress();
        $this->_city->load($address->getCityId());
        $this->_region->load($address->getRegionId());
        $order->setAddress(
            [
                'city' => $this->_city->getName(),
                'region' => $this->_region->getName(),
                'postal_code' => $address->getPostalCode(),
                'street' => $address->getStreet(),
                'home_number' => $address->getHomeNumber(),
                'flat' => $address->getFlat()
            ]
        );
    }
}