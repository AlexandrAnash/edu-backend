<?php
namespace App\Model\Resource\Table;
class Customer implements IProductReview
{
    public function getName()
    {
        return 'customers';
    }

    public function getPrimaryKey()
    {
        return 'customer_id';
    }
}