<?php

namespace App\Form\Input;

class Option
{

    private $value;
    private $label;
    private $selected;

    public function __construct($value, $label, $selected = false)
    {
        $this->value = $value;
        $this->label = $label;
        $this->selected = $selected;
    }

    public function html()
    {
        return '<option value="'.$this->value.'" '.($this->selected ? 'selected="selected"' : '').'>
                    '.strtoupper($this->label).'
                </option>';
    }

    public function json()
    {
        return '{
            value: "'.$this->value.'",
            label: "'.$this->label.'"
        },';
    }
}
