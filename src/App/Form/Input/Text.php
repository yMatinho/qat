<?php

namespace App\Form\Input;

class Text extends Input {

    public function __construct($name, $label, $required=true, $value='', $extraAttributes=[])
    {
        parent::__construct($name, $label, $required, $value, $extraAttributes);
    }

    public function html() {
        return '<app-input col-size="12" type="text" required="'.$this->required.'" field_id="'.$this->name.'" field_label="'.$this->label.'" field_value="'.$this->value.'"></app-input>';
    }
}
