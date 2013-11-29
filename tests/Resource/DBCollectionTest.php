<?php
/**
 * Created by PhpStorm.
 * User: Admin
 * Date: 26.11.13
 * Time: 22:59
 */
require_once __DIR__ . '/../../src/models/Resource/DBCollection.php';
class DBCollectionTest
    extends PHPUnit_Extensions_Database_TestCase
{
    public function testFetchesDataFromDb()
    {
        $collection = new DBCollection($this->getConnection()->getConnection(), 'abstract_collection');
        //print_r($collection->fetch());
        $this->assertEquals([
            ['id' => 1, 'data' => 'foo'],
            ['id' => 2, 'data' => 'bar']
            ], $collection->fetch());
    }

    protected function getConnection()
    {
        $pdo = new PDO('mysql:host=localhost; dbname=student_unit', 'root', '123');
        return $this->createDefaultDBConnection($pdo, 'student_unit');
    }

    protected function getDataSet()
    {
        return new PHPUnit_Extensions_Database_DataSet_YamlDataSet(
            __DIR__ . '/DBCollectionTest/fixtures/abstract_collection.yaml'
        );
    }
}
 