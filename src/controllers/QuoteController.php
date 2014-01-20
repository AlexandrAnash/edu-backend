<?php
namespace App\Controller;

class QuoteController
    extends SalesController
{
    public function addAction()
    {
        $quoteItem = $this->_initQuoteItem();
        $qty = $_POST['quote']['count'];

        $quoteItem->addQty($qty);
        $quoteItem->save();
        $this->_redirect('quote_list');
    }

    public function deleteAction()
    {
        $quoteItem = $this->_initQuoteItem();
        $qty = $_POST['quote']['count'];
        $quoteItem->delete($qty);
        if ($quoteItem->getQty() == 0)
            $quoteItem->remove();
        else
            $quoteItem->save();
        $this->_redirect('quote_list');
    }

    public function listAction()
    {
        $quote = $this->_initQuote();
        $items = $quote->getItems();
        $items->assignProducts($this->_di->get('Product'));

        return $this->_di->get('View', [
            'template' => 'cart_list',
            'params'   => ['items' => $items]
        ]);
    }

    private function _initQuoteItem()
    {
        $quote = $this->_initQuote();

        $product = $this->_di->get('Product');
        $product->load($_POST['quote']['product_id']);

        $item = $quote->getItems()->forProduct($product);
        return $item;
    }

}