<?php

namespace App\Model\Quote;

use App\Model\Order;
use App\Model\Quote;
use App\Model\Quote\ConverterFactory;

class Converter
{
    private $_converterFactory;

    public function __construct(ConverterFactory $converterFactory)
    {
        $this->_converterFactory = $converterFactory;
    }

    public function toOrder(Quote $quote, Order $order)
    {
        foreach ($this->_converterFactory->getConverters() as $converter) {
            $converter->toOrder($quote, $order);
        }
    }
}