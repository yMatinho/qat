<?php

namespace App\Form;

use App\Form\Input\Composite\InputComposite;
use App\Form\Input\Composite\InputComponent;

class CrudFormFactory extends FormFactory
{
    private $hiddens;
    private $action_label;
    private $form_id;

    public function __construct($form_id, $leafs, $method, $action, $action_label, $hiddens = null)
    {
        parent::__construct($leafs, $method, $action);
        $this->hiddens = $hiddens;
        $this->form_id = $form_id;
        $this->action_label = $action_label;
    }

    public function makeHtml()
    {
        $inputs = new InputComposite($this->leafs);

        $hiddenInputs = '';
        if (!empty($this->hiddens)) {
            foreach ($this->hiddens as $hiddenName => $hiddenValue)
                $hiddenInputs .= '<input type="hidden" name="' . $hiddenName . '" value="' . $hiddenValue . '">';
        }

        return '
        <app-form method="'.$this->method.'" action="'.$this->action.'" action_label="'.$this->action_label.'" :ajax="false" form_id="'.$this->form_id.'">
            <div class="row">
            '.$hiddenInputs.'
            ' . $inputs->html() . '
            </div>
        </app-form>';
    }
}
