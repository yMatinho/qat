<?php

namespace Framework\DB\Table;

class Table {
    protected $table;
    protected $collumns;
    
    public function __construct(string $table, array $collumns)
    {
        $this->table = $table;
        $this->collumns = $collumns;
    }

    public function getTable() {
        return $this->table;
    }

    public function getCollumns() {
        return $this->collumns;
    }
}