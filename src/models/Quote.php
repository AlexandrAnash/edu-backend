<?php
namespace App\Model;


class Quote
    extends Entity
{
    private $_items;
    private $_address;
    private $_collectorsFactory;
    private $_session;

    public function __construct(
        array $data = [],
        Resource\IResourceEntity $resource = null,
        QuoteItemCollection $items = null,
        Address $address = null,
        Quote\CollectorsFactory $collectorsFactory = null
    ) {
        $this->_items = $items;
        $this->_address = $address;
        $this->_collectorsFactory = $collectorsFactory;
        parent::__construct($data, $resource);
    }

    public function loadBySession(Session $session)
    {

        if ($session->getQuoteId()) {
            $this->load($session->getQuoteId());
        } else {
            $this->save();
            $session->setQuoteId($this->getId());
        }
        $this->_session = $session;

    }

    public function loadByCustomers(Customer $customer)
    {
        if ($customer->getQuoteId()) {
            $this->load($customer->getQuoteId());
        } else {
            $this->save();
            $customer->setQuoteId($this->getId());
        }
    }

    public function getItems()
    {
        $this->_items->filterByQuote($this);
        return $this->_items;
    }

    public function getCustomer()
    {
        if ($this->_session->isLoggedIn())
            return $this->_session->getCustomer();
        return null;
    }

    public function getAddress()
    {
        if ($addressId = $this->_getData('address_id')) {
            $this->_address->load($this->_getData('address_id'));
        } else {
            $this->_address->save();
            $this->_assignAddress();
        }
        return $this->_address;
    }

    protected function _assignAddress()
    {
        $this->_data['address_id'] = $this->_address->getId();
        $this->save();
    }

    public function setShippingData($data)
    {
        $this->_data['shipping_method_code'] =  $data;
        $this->save();
    }

    public function setPaymentData($data)
    {
        $this->_data['payment_method_code'] = $data;
        $this->save();
    }

    public function collectTotals()
    {
        //var_dump($this->_collectorsFactory);
        foreach ($this->_collectorsFactory->getCollectors() as $field => $collector) {
            $this->_data[$field] = $collector->collect($this);
        }
    }

    public function getShippingData()
    {
        return $this->_getData('shipping_method_code');
    }


    public function getPaymentData()
    {
        return $this->_getData('payment_method_code');
    }

    public function getSubtotal()
    {
        return $this->_getData('subtotal');
    }

    public function getShipping()
    {
        return $this->_getData('shipping');
    }

    public function getGrandTotal()
    {
        return $this->_getData('grand_total');
    }
}