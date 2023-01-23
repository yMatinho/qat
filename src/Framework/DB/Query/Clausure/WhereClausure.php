<?php

namespace Framework\DB\Query\Clausure;

class WhereClausure {
    private bool $subclausure;
    private $logicalOperator;
    private array $comparisons;

    public function __construct(array $comparisons, $logicalOperator = "", bool $subclausure = false)
    {
        $this->comparisons = $comparisons;
        $this->subclausure = $subclausure;
    }

    public function get() {
        $whereContent = "";

        foreach($this->comparisons as $key=>$comparison)
            $whereContent .= $this->logicalOperator." ".($this->subclausure ? "(" : "").$comparison->get($key != 0).($this->subclausure ? ")" : "")." ";

        return $whereContent;
    }

    public function getComparisons() {
        return $this->comparisons;
    }
}