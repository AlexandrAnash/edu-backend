<?php

namespace App\Model\Quote;


use App\Model\Order;
use App\Model\Product;
use App\Model\Quote;

class ItemsConverter
    implements IConverter
{
    private $_product;

    public function __construct(Product $prototype)
    {
        $this->_product = $prototype;
    }


    public function toOrder(Quote $quote, Order $order)
    {
        $items = [];
        foreach ($quote->getItems() as $item)
        {
            $this->_product->load($item->getProductId());
            $price = ($this->_product->isSpecialPriceApplied()) ?
                $this->_product->getSpecialPrice() : $this->_product->getPrice();
            $items[] = [
                'product_name' => $this->_product->getName(),
                'product_sku' => $this->_product->getSku(),
                'product_qty' => $item->getQty(),
                'product_price' => $price
                ];
        }
        $order->setItemsProduct($items);

    }
}