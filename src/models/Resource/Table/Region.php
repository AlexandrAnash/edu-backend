<?php
namespace App\Model\Resource\Table;
class Region implements ITable
{
    public function getName()
    {
        return 'region';
    }

    public function getPrimaryKey()
    {
        return 'region_id';
    }
}