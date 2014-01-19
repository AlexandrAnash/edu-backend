<?php

namespace App\Model\Quote;

use App\Model\Product;
use App\Model\Quote;
use App\Model\QuoteItem;

class SubtotalCollector
    implements ICollector
{
    private $_product;
    public function __construct(Product $product)
    {
        $this->_product = $product;
    }

    public function collect(Quote $quote)
    {
        $subtotal = 0;
        foreach ($quote->getItems() as $quoteItem)
        {
            $this->_product->load($quoteItem->getProductId());
            $priceProduct = $this->_product->isSpecialPriceApplied() ?
                $this->_product->getSpecialPrice() :
                $this->_product->getPrice();
            $subtotal += $quoteItem->getQty() * $priceProduct;
        }
        return $subtotal;
    }
}