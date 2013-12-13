<?php

namespace App\Controller;

use App\Model\Quote;
use App\Model\Resource\DBCollection;
use App\Model\Resource\DBEntity;
use App\Model\CartCollection;
use App\Model\Cart;
use App\Model\Resource\Table\Cart as QuoteTable;
use App\Model\Resource\Table\Product as ProductTable;
use App\Model\Session;
use App\Model\Product;

class CartController
{

    public function addAction()
    {
        $quoteItem = $this->_initQuoteItem();
        if (!$quoteItem) {
            $quoteItem->addQty($_POST['qty']);
        } else {
            $quoteItem->updateQty($_POST['qty']);
        }
        $quoteItem->save(new QuoteItemResource);
    }

    public function updateAction()
    {
        $quoteItem = $this->_initQuoteItem();
        $quoteItem->updateQty($_POST['qty']);
        $quoteItem->save(new QuoteItemResource);
    }

    public function deleteAction()
    {
        $quoteItem = $this->_initQuoteItem();
        $quoteItem->delete(new QuoteItemResource);
    }

    public function listAction()
    {
        $quote = $this->_initQuote();
        $quoteItems = new QuoteItemCollection(new QICollectionResource);
        $quoteItems->filterByQuote($quote);
        $quoteItems->assignProducts(new Product(), new ProductResource);

        /*
        // quote item collection:
        foreach ($this as $_item) {
            $product = clone $prototype; // Product
            $product->load($_item->getId());
            $_item->assignProduct($product); // call getProduct in template
        }
        */
    }

    private function _initQuoteItem()
    {
        $quote = $this->_initQuote();

        $product = new Product([]);
        $product->load(new ProductTable, $_POST['product_id']);

        $quoteItem = $quote->getItemForProduct($product);
        return $quoteItem;
    }

    private function _initQuote()
    {
        $quote = new Quote(new QuoteTable);
        $session = new Session; // get session
        if ($session->isLoggedIn()) {
            $quote->loadByCustomer($session->getCustomer());
            return $quote;
        } else {
            $quote->loadBySession($session->getSessionId());
            return $quote;
        }
    }

} 