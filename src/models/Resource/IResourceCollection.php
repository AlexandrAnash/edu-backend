<?php
namespace App\Model\Resource;

interface IResourceCollection
{
    public function fetch();
    public function filterLikeBy($column, $value);
    public function filterBy($column, $value);
    public function Average($column);
    public function limit($limit, $offset = 0);
    public function sort($orderBy);
    public function count();
}