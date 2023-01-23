<?php

namespace App\Form\Input;

abstract class Input {
    protected $name;
    protected $value;
    protected $required;
    protected $extraAttributes;
    protected $label;

    protected function __construct($name, $label, $required, $value='', $extraAttributes=[])
    {
        $this->name = $name;
        $this->label = $label;
        $this->required = $required;
        $this->value = $value;
        $this->extraAttributes = $extraAttributes;
    }

    abstract function html();

    public function getName() {
        return $this->name;
    }
    public function getLabel() {
        return $this->label;
    }
    public function getValue() {
        return $this->value;
    }
    public function getExtraAttributes() {
        return $this->extraAttributes;
    }
    public function isRequired() {
        return $this->required;
    }
}