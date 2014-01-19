<?php

namespace App\Model\Payment;


use App\Model\Address;

class CashOnDelivery implements IMethod
{

    public function getCode()
    {
        return 'Cash on delivery';
    }

    public function isAvailable(Address $address)
    {
        return true;
    }

    public function getLabel()
    {
        return 'Cash on delivery';
    }
}