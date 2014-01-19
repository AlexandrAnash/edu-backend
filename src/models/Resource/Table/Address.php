<?php
namespace App\Model\Resource\Table;
class Address implements ITable
{
    public function getName()
    {
        return 'address';
    }

    public function getPrimaryKey()
    {
        return 'address_id';
    }
}