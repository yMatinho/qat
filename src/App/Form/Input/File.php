<?php

namespace App\Form\Input;

class File extends Input {

    private $isImage;
    private $previewSize;

    public function __construct($name, $label, $isImage, $previewSize=200, $required=true, $value='', $extraAttributes=[])
    {
        parent::__construct($name, $label, $required, $value, $extraAttributes);
        $this->isImage = $isImage;
        $this->previewSize = $previewSize;
    }

    public function html() {
        return '<app-input col-size="12" type="'.($this->isImage ? "image" : "file").'" field_value="'.$this->value.'" field_id="'.$this->name.'" field_label="'.$this->label.'" preview_size="'.$this->previewSize.'"></app-input>';
    }
}