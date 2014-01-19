<?php

namespace App\Model\Shipping;

use App\Model\Address;

class TableRate implements IMethod
{
    private $_priceTable = ['4851' => 1000.00, '4400' => 99.00, '74' => 30.00];
    private $_code = 'Table rate';
    private $_address;

    public function __construct(Address $address)
    {
        $this->_address = $address;
    }

    public function getPrice()
    {
       $price = $this->_priceTable[$this->_address->getCityId()];
       return isset($this->_priceTable[$this->_address->getCityId()])
           ? $this->_priceTable[$this->_address->getCityId()] : null ;
    }

    public function getCode()
    {
        return $this->_code;
    }

    public function getLabel()
    {
        return "Table Rate";
    }
}