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

    public function testFetchesFilteredData()
    {
        $collection = new DBCollection($this->getConnection()->getConnection(), 'abstract_collection');
        $collection->filterBy('id', 1);
        $this->assertEquals([
            ['id' => 1, 'data' => 'foo']
        ], $collection->fetch());

        $collection = new DBCollection($this->getConnection()->getConnection(), 'abstract_collection');
        $collection->filterBy('data', 'bar');
        $collection->filterBy('id', 2);
        $this->assertEquals([
            ['id' => 2, 'data' => 'bar']
        ], $collection->fetch());
    }


    /**
     * @dataProvider getColumns
     */
    public function testCalculatesAverageAmountByColumn($column, $values)
    {
        $collection = new DBCollection($this->getConnection()->getConnection(), 'abstract_collection');
        $expected = [
            1 => (1+2+3)/3,
            2 => (10+11+12)/3,
        ];
        $this->assertEquals($expected[$values], $collection->Average($column));
    }

    public function getColumns()
    {
        return [['id', 1], ['data', 2]];
    }


    protected function getConnection()
    {
        $pdo = new PDO('mysql:host=localhost; dbname=student_unit', 'root', '123');
        return $this->createDefaultDBConnection($pdo, 'student_unit');
    }

    protected function getDataSet()
    {
        return new PHPUnit_Extensions_Database_DataSet_YamlDataSet(
            __DIR__ . '/DBCollectionTest/fixtures/' . $this->getName(false) . '.yaml'
        );
    }
}
 