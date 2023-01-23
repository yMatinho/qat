<?php

namespace App\Form\Input\Composite;

use App\Form\Input\Input;

class InputGroupLeaf implements InputComponent
{
    private array $inputs;
    private $colSize;

    public function __construct(array $inputs, $colSize = 12)
    {
        $this->inputs = $inputs;
        $this->colSize = $colSize;
    }

    public function html()
    {
        $finalHtml = '<div class="col-md-' . $this->colSize . '">';

        foreach ($this->inputs as $input) 
            $finalHtml .= $input->html();

        $finalHtml .= '</div>';

        return $finalHtml;
    }

    public function add(InputComponent $leaf)
    {
    }
    public function remove($leafIndex)
    {
    }
    public function get($leafIndex)
    {
    }
}
