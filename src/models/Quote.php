<?php
namespace App\Model;
use App\Model\Resource\IResourceCollection;
use App\Model\Resource\IResourceEntity;

class Quote extends Resource\DBCollection
{
    private $_resource;
    private $_session;
    private $_customer;
    private $_sessionUser;
    private $_filterBy;


    public function __construct(IResourceCollection $resource)
    {
        $this->_resource = $resource;
    }

    public function loadByCustomer($getCustomer)
    {
        $this->_resource->filterBy('customer_id', $getCustomer);
        $this->_sessionUser = $getCustomer;
    }

    public function loadBySession($getSessionId)
    {
        $this->_resource->filterBy('session_id', $getSessionId);
        $this->_sessionUser = $getSessionId;
    }

    public function getItemForProduct(Product $product)
    {
        $this->_resource->filterBy('product_id', $product->getId());

        return reset($this->_resource->fetch());
    }

    public function addQty($count = 1)
    {
        $quoteEntity = new QuoteItem([
            'count'       => $count,
            'product_id'  => $_POST['cart']['product_id'],
            'customer_id' => $this->_sessionUser
        ]);
        return $quoteEntity;

    }

    public function updateQty($count = 1)
    {
        //$resource = $this->getItemForProduct()
        return array_map(
            function($data) use ($count) {
                $data['count'] += $count;
                return new QuoteItem($data);
            },
            $this->_resource->fetch()
        );


    }


}
