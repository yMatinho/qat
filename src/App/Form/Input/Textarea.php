<?php

namespace App\Form\Input;

class Textarea extends Input {

    private $summernote;

    public function __construct($name, $label, $required=true, $value='', $summernote=false, $extraAttributes=[])
    {
        parent::__construct($name, $label, $required, $value, $extraAttributes);
        $this->summernote = $summernote;
    }

    public function html() {
        return '<app-input col-size="12" type="textarea" required="'.$this->required.'" field_id="'.$this->name.'" field_label="'.$this->label.'" field_value="'.$this->value.'"></app-input>';
    }
}
