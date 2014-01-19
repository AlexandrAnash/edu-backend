<?php
namespace App\Model\Resource\Table;
class City implements ITable
{
    public function getName()
    {
        return 'city';
    }

    public function getPrimaryKey()
    {
        return 'city_id';
    }
}