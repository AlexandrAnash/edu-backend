<?php
namespace App\Model\Resource\Table;
class Cart implements IProductReview
{
    public function getName()
    {
        return 'cart';
    }

    public function getPrimaryKey()
    {
        return 'cart_id';
    }
}