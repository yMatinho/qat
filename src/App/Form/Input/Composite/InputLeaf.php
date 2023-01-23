<?php

namespace App\Form\Input\Composite;

use App\Form\Input\Input;
use Illuminate\Support\Facades\Session;

class InputLeaf implements InputComponent
{
    private Input $input;

    public function __construct(Input $input)
    {
        $this->input = $input;
    }

    public function html()
    {

        return $this->input->html();
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
