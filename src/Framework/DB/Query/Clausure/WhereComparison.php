<?php

namespace Framework\DB\Query\Clausure;

class WhereComparison {
    private $operator;
    private $collumn;
    private $value;
    private $logicalOperator;

    public function __construct($collumn, $operator, $value, $logicalOperator="AND")
    {
        $this->operator = $operator;
        $this->collumn = $collumn;
        $this->value = $value;
        $this->logicalOperator = $logicalOperator;
    }

    public function get($includeLogicalOperator=false) {
        return ($includeLogicalOperator ? $this->logicalOperator." " : " ")."$this->collumn $this->operator $this->value";
    }
    
}