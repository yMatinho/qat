<?php

namespace Framework\DB\Query\Builder\Select;

class SelectQueryDirector
{
    private ISelectQueryBuilder $builder;
    private $orderBy;
    private $orderByOrder;
    private $limit;
    public function __construct(ISelectQueryBuilder $builder, $orderBy="", $orderByOrder="", $limit="")
    {
        $this->builder = $builder;
        $this->orderBy = $orderBy;
        $this->orderByOrder = $orderByOrder;
        $this->limit = $limit;
    }

    public function makeQuery() {
        $query = $this->builder->partInitial();
        $query.=$this->builder->partClausures();
        $query.=$this->builder->partOrderBy($this->orderBy, $this->orderByOrder);
        $query.=$this->builder->partLimit($this->limit);

        return $query;
    }
}
