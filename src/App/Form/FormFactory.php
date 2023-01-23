<?php

namespace App\Form;

use App\Form\Input\Composite\InputComponent;

abstract class FormFactory {

    protected $leafs;
    protected $method;
    protected $action;

    protected function __construct(array $leafs, $method, $action)
    {
        $this->leafs = $leafs;
        $this->method = $method;
        $this->action = $action;
    }

    abstract function makeHtml();
}