<?php
namespace App\Model\Resource;

use Zend\Db\Adapter\Adapter;
use Zend\Db\Adapter\Driver\Pdo\Pdo;
use Zend\Db\Sql\Predicate\Expression;
use Zend\Db\Sql\Select;
use Zend\Db\Sql\Sql;
use Zend\Stdlib\ArrayUtils;

class DBCollection
    implements IResourceCollection
{
    private $_connection;
    private $_table;
    private $_filterBy = [];
    private $_bind = [];
    private $_sql;
    private $_select;

    public function __construct(\PDO $connection, Table\ITable $table)
    {
        $this->_connection = $connection;
        $this->_table = $table;

        $driver = new Pdo($this->_connection);
        $adapter = new Adapter($driver);
        $this->_sql = new Sql($adapter);
        $this->_select = new Select($this->_table->getName());

    }

    public function fetch()
    {
        $results = $this->_executeSelect($this->_select);
        return ArrayUtils::iteratorToArray($results);
    }

    public function filterLikeBy($column, $value)
    {
        $this->_select->where("{$column} LIKE :{$column}");
        $this->_bind[$column] = $value;
        $this->_filterBy[$column] = $value;
    }

    public function filterBy($column, $value)
    {
        $this->_select->where("{$column} = :{$column}");
        $this->_bind[$column] = $value;
        $this->_filterBy[$column] = $value;
    }


    public function Average($column)
    {
        $result = $this->_executeSelect(
            $this->_select,
            ['avg' => new Expression("AVG({$column})")]
        );
        return $result->current()['avg'];
    }

    public function limit($limit, $offset = 0)
    {
        $this->_select
            ->limit($limit)
            ->offset($offset);
    }

    public function count()
    {
        $select = clone $this->_select;
        $select
            ->reset(Select::LIMIT)
            ->reset(Select::OFFSET);
        $result = $this->_executeSelect(
            $select,
            ['count' => new Expression("COUNT(*)")]
        );
        return $result->current()['count'];
    }


    private function _executeSelect(Select $select, $columns = null)
    {
        if ($columns) {
            $select->columns($columns);
        }

        $statement = $this->_sql->prepareStatementForSqlObject($select);
        $result = $statement->execute($this->_bind);
        return $result;
    }
//    private function _prepareSql($columns = '*')
//    {
//        $sql = "SELECT {$columns} FROM {$this->_table->getName()} ";
//        if ($this->_filterBy) {
//            $sql .= "WHERE " . $this->_prepareFilters();
//        }
//        $stmt = $this->_connection
//            ->prepare($sql);
//
//        if ($this->_bind) {
//            $this->_bindValues($stmt);
//        }
//        $stmt->execute();
//        return $stmt;

//    }


//    private function _prepareFilters()
//    {
//        $conditions = [];
//        foreach ($this->_filterBy as $column => $value) {
//            $parameter = ':_param_' . $column;
//            $conditions[] = $column . ' = ' . $parameter . '';
//            $this->_bind[$parameter] = $value;
//        }
//        return implode(" AND ", $conditions);
//    }

    private function _bindValues(\PDOStatement $stmt)
    {
        foreach ($this->_bind as $parameter => $value) {
            $stmt->bindValue($parameter, $value);
        }
    }

    //public function limit($limit)
    //{
//
    //}


}