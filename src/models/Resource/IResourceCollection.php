<?php
namespace App\Model\Resource;

interface IResourceCollection
{
    public function fetch();
    public function whereProduct();
    public function filterBy($column, $value);
    public function Average($column);
} 