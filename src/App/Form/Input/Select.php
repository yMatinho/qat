<?php

namespace App\Form\Input;

class Select extends Input {

    private array $options;

    public function __construct($name, $label, $options, $required=true, $value='', $extraAttributes=[])
    {
        parent::__construct($name, $label, $required, $value, $extraAttributes);
        $this->options = $options;
    }

    public function html() {
        return '<app-select
            name="'.$this->name.'"
            label="'.$this->label.'"
            options="'.$this->optionsJson().'"
            :required="'.$this->required.'"
            value="'.$this->value.'"
        ></app-select>';
    }

    private function optionsJson() {
        $optionsJson = '[';
        foreach($this->options as $option)
            $optionsJson.=$option->json();
        $optionsJson = "]";

        return $optionsJson;
    }
}