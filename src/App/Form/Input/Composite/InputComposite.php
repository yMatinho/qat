<?php

namespace App\Form\Input\Composite;

use App\Form\Input\Composite\InputComponent;

class InputComposite implements InputComponent
{
    private $leafs;
    public function __construct(array $leafs)
    {
        $this->leafs = $leafs;
    }

    public function html()
    {
        $html = '';
        foreach ($this->leafs as $leaf)
            $html .= $leaf->html();

        return $html;
    }

    public function add(InputComponent $leaf) {
        $this->leafs[] = $leaf;
    }
    public function remove($leafIndex) {
        unset($this->leafs[$leafIndex]);
    }
    public function get($leafIndex) {
        return $this->leafs[$leafIndex];
    }
}
