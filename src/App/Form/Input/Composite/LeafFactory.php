<?php

namespace App\Form\Input\Composite;

use App\Form\Input\Input;

class LeafFactory {
    public function __construct()
    {

    }

    public function makeLeaf(Input $input) {
        return (new InputLeaf($input));
    }

    public function makeInputGroup(array $inputs, $colSize=12) {
        $inputLeafs = [];
        foreach($inputs as $input)
            $inputLeafs[] = $this->makeLeaf($input);
        return (new InputGroupLeaf($inputLeafs, $colSize));
    }
}
