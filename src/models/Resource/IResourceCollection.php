<?php
namespace App\Model\Resource;

interface IResourceCollection
{
    public function fetch();
    public function where();
    public function filterBy($column, $value);
    public function Average($column);
}