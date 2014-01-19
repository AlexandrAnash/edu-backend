<?php
namespace Test\Model\Resource;
use App\Model\Resource\DBCollection;
class DBCollectionTest
    extends \PHPUnit_Extensions_Database_TestCase
{
    public function testFetchesDataFromDb()
    {
        //$collection = new DBCollection($this->getConnection()->getConnection(), 'abstract_collection');
        $collection = $this->_getCollection();
        //print_r($collection->fetch());
        $this->assertEquals([
            ['id' => 1, 'data' => 'foo'],
            ['id' => 2, 'data' => 'bar']
            ], $collection->fetch());
    }

    public function testFetchesFilteredData()
    {
        //$collection = new DBCollection($this->getConnection()->getConnection(), 'abstract_collection');
        $collection = $this->_getCollection();
        $collection->filterBy('id', 1);
        $this->assertEquals([
            ['id' => 1, 'data' => 'foo']
        ], $collection->fetch());

        //$collection = new DBCollection($this->getConnection()->getConnection(), 'abstract_collection');
        $collection = $this->_getCollection();
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
        //$collection = new DBCollection($this->getConnection()->getConnection(), 'abstract_collection');
        $collection = $this->_getCollection();
        $expected = [
            1 => (1+2+3)/3,
            2 => (10+11+12)/3,
        ];
        $this->assertEquals($expected[$values], $collection->Average($column));
    }

    /**
    * @dataProvider getLimitAmounts
    */
    public function testLimitItemBySpecifiedAmount($limit)
    {
        $expected = [
            1 => [['id' => 1, 'data' => 'foo']],
            2 => [['id' => 1, 'data' => 'foo'], ['id' => 2, 'data' => 'bar']]
        ];
        $collection = $this->_getCollection();
        $collection->limit($limit);
        //var_dump($collection->fetch());
        $this->assertEquals($expected[$limit], $collection->fetch());
    }

    /**
     * @dataProvider getOffsetAmounts
     */
    public function testOffsetItemBySpecifiedAmount($offset)
    {
        $expected = [
            1 => [['id' => 2, 'data' => 'bar'], ['id' => 3, 'data' => 'baz']],
            2 => [['id' => 3, 'data' => 'baz']]

        ];
        $collection = $this->_getCollection();
        $collection->limit(100, $offset);
        //var_dump($collection->fetch());
        $this->assertEquals($expected[$offset], $collection->fetch());
    }

    public function testCalculatesItemCount()
    {
        $collection = $this->_getCollection();
        $collection->limit(0);
        $collection->filterBy('data', 'foo');

        $this->assertEquals(3, $collection->count());
    }

    public function getLimitAmounts()
    {
        return
        [
            [1],
            [2]
        ];
    }

    public function getOffsetAmounts()
    {
        return
            [
                [1],
                [2]
            ];
    }

    public function getColumns()
    {
        return [['id', 1], ['data', 2]];
    }


    protected function getConnection()
    {
        $pdo = new \PDO('mysql:host=localhost; dbname=student_unit', 'root', '123');
        return $this->createDefaultDBConnection($pdo, 'student_unit');
    }

    protected function getDataSet()
    {
        return new \PHPUnit_Extensions_Database_DataSet_YamlDataSet(
            __DIR__ . '/DBCollectionTest/fixtures/' . $this->getName(false) . '.yaml'
        );
    }

    private function _getCollection()
    {
        $table = $this->getMock('\App\Model\Resource\Table\ITable');
        $table->expects($this->any())->method('getName')
            ->will($this->returnValue('abstract_collection'));
        $collection = new DBCollection($this->getConnection()->getConnection(), $table);
        return $collection;
    }
}
 