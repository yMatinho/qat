<?php

namespace Framework\DB\Query;

use Framework\DB\Table\Table;

abstract class QueryFactory {
    protected Table $table;
    protected function __construct(Table $table)
    {
        $this->table = $table;
    }

    abstract function insert($values, $collumns=null);
    abstract function select($clausures, $fields="*", $orderBy = "", $orderByOrder = "ASC", $limit = "");
    abstract function update(array $identificator, $values, $collumns = null);
    abstract function delete($identificator);

}