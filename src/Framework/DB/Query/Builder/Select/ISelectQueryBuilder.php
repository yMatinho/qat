<?php

namespace Framework\DB\Query\Builder\Select;

interface ISelectQueryBuilder {
    public function partInitial();
    public function partClausures();
    public function partOrderBy($orderBy="", $orderByOrder="");
    public function partLimit($limit=0);
}