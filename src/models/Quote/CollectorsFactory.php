<?php

namespace App\Model\Quote;


use App\Model\Product;

class CollectorsFactory
{
    private $_product;

    public function __construct(Product $product)
    {
        $this->_product = $product;
    }

    public function getCollectors()
    {
        return [
            'subtotal' => new SubtotalCollector($this->_product),
            'shipping' => new ShippingCollector,
            'grand_total' => new GrandTotalCollector
        ];
    }
}