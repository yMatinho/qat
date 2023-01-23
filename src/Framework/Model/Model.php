<?php

namespace Framework\Model;

use Framework\DB\DB;
use Framework\DB\MySQLDB;
use Framework\DB\Query\Clausure\WhereClausure;
use Framework\DB\Query\Clausure\WhereComparison;
use Framework\DB\Query\MySQLQueryFactory;
use Framework\DB\Table\Table;

abstract class Model
{
    protected static Table $table;
    protected array $modelValues;

    protected function __construct()
    {
        $this->modelValues = [];
    }

    abstract static function init():void;

    public function __set($name, $value)
    {
        $this->modelValues[$name] = $value;
    }

    public function __get($name)
    {
        return $this->$name;
    }

    public function save()
    {
        if (array_key_exists('id', $this->modelValues))
            $this->update();
        else
            $this->insert();
    }

    protected function insert()
    {
        $bruteInsertData = $this->getModelsReadyToBeQueried();
        $queryFactory = new MySQLQueryFactory(self::$table);
        $query = $queryFactory->insert($this->getValues($bruteInsertData), $this->getCollumns($bruteInsertData));
        MySQLDB::get()->rawQuery($query);
    }
    protected function update()
    {
        $bruteInsertData = $this->getModelsReadyToBeQueried();
        $queryFactory = new MySQLQueryFactory(self::$table);
        $query = $queryFactory->update(["id"=>$this->modelValues['id']], $this->getValues($bruteInsertData), $this->getCollumns($bruteInsertData));
        MySQLDB::get()->rawQuery($query);
    }
    public static function delete($id)
    {
        $queryFactory = new MySQLQueryFactory(self::$table);
        $query = $queryFactory->delete(["id"=>$id]);
        MySQLDB::get()->rawQuery($query);
    }
    public static function all($fields="*", $orderBy="", $orderByOrder="", $limit="")
    {
        $queryFactory = new MySQLQueryFactory(self::$table);

        $query = $queryFactory->select([], $fields, $orderBy, $orderByOrder, $limit);
        return MySQLDB::get()->rawQuery($query, true);
    }

    public static function first($fields="*")
    {
        $queryFactory = new MySQLQueryFactory(self::$table);

        $query = $queryFactory->select([], $fields, "id", "DESC", 1);
        return MySQLDB::get()->rawQuery($query, true);
    }

    public static function find($id) {
        return self::select([
            (new WhereClausure([
                (new WhereComparison("id", "=", $id))
            ]))
        ], "*", "", "", 1);
    }

    public static function select(array $clausures, $fields="*", $orderBy="", $orderByOrder="", $limit="")
    {
        $queryFactory = new MySQLQueryFactory(self::$table);
        $query = $queryFactory->select($clausures, $fields, $orderBy, $orderByOrder, $limit);
        return MySQLDB::get()->rawQuery($query, true, ($limit > 1 || $limit == null));
    }

    private function getValues($data)
    {
        return array_values($data);
    }
    private function getCollumns($data)
    {
        return array_keys($data);
    }
    private function getModelsReadyToBeQueried()
    {
        $arr = array_filter($this->modelValues, function ($key) {
            if ($key == 'id')
                return false;
            return true;
        }, ARRAY_FILTER_USE_KEY);

        return array_map(function($value) {
            return ["value"=>$value, "type"=>gettype($value)];
        }, $arr);
    }
}
