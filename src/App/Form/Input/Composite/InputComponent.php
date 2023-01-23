<?php

namespace App\Form\Input\Composite;

interface InputComponent {
    public function html();
    public function add(InputComponent $leaf);
    public function remove($leafIndex);
    public function get($leafIndex);
}