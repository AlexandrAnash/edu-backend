<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 27.11.13
 * Time: 0:11
 */
require_once __DIR__ . '/../../src/models/Resource/DBEntity.php';
class DBEntityTest extends PHPUnit_Extensions_Database_TestCase
{
    public function testReturnsFoundDataFromDb()
    {
        $resource = new DBEntity(
            $this->getConnection()->getConnection(), 'abstract_collection', 'id'
        );
        //print_r($resource->find(1));
        $this->assertEquals(['id' => 1, 'data' => 'foo'], $resource->find(1));
        $this->assertEquals(['id' => 2, 'data' => 'bar'], $resource->find(2));
    }

    protected function getConnection()
    {
        $pdo = new PDO('mysql:host=localhost; dbname=student_unit', 'root', '123');
        return $this->createDefaultDBConnection($pdo, 'student_unit');
    }

    protected function getDataSet()
    {
        return new PHPUnit_Extensions_Database_DataSet_YamlDataSet(
            __DIR__ . '/DBEntityTest/fixtures/abstract_entity.yaml'
        );
    }
}
 