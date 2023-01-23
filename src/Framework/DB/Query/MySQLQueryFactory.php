<?php

namespace Framework\DB\Query;

use Framework\DB\Query\Builder\Select\MySQLSelectQueryBuilder;
use Framework\DB\Query\Builder\Select\SelectQueryDirector;
use Framework\DB\Query\QueryFactory;
use Framework\DB\Table\Table;

class MySQLQueryFactory extends QueryFactory
{
    public function __construct(Table $table)
    {
        parent::__construct($table);
    }

    public function insert($values, $collumns = null): string
    {
        if (!$collumns)
            $collumns = $this->table->getCollumns();
        $values = array_map(function ($value) {
            if ($value['type'] == "string")
                return "'" . $value["value"] . "'";
            return $value['value'];
        }, $values);
        return "INSERT INTO " . $this->table->getTable() . "(" . implode(', ', $collumns) . ") VALUES(" . implode(', ', $values) . ")";
    }
    public function select($clausures, $fields = "*", $orderBy = "", $orderByOrder = "ASC", $limit = ""): string
    {
        $queryBuilder = new MySQLSelectQueryBuilder($this->table, $clausures, $fields);
        $queryDirector = new SelectQueryDirector($queryBuilder, $orderBy, $orderByOrder, $limit);

        return $queryDirector->makeQuery();
    }


    /* identifcator should look like this: [table_collumn=>table_value] */
    public function update(array $identificator, $values, $collumns = null): string
    {
        $collumns = $this->getCollumnsWithoutId($collumns);
        $values = array_map(function ($collumn, $value) {
            if($value == null)
                return;
            if ($value['type'] == "string")
                return "$collumn='" . $value["value"] . "'";
            return $value['value'];
        }, $collumns, $values);
        $identificatorQueryConversion = array_keys($identificator)[0] . ' = ' . $identificator[array_keys($identificator)[0]];
        return "UPDATE `" . $this->table->getTable() . "` SET " . (implode(',', $values)) . " WHERE $identificatorQueryConversion";
    }
    public function delete($identificator): string
    {
        $identificatorQueryConversion = array_keys($identificator)[0] . ' = ' . $identificator[array_keys($identificator)[0]];
        return "DELETE FROM `" . $this->table->getTable() . "` WHERE $identificatorQueryConversion";
    }

    private function getCollumnsWithoutId($collumns) {
        if (!$collumns)
            $collumns = $this->table->getCollumns();
        $collumns = array_filter($collumns, function($value) {
            if($value == "id")
                return false;
            return true;
        });

        return $collumns;
    }
}
