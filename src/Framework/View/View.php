<?php

namespace Framework\View;

class View {
    private $html;

    public function __construct($html)
    {
        $this->html = $html;
    }

    public function html() {
        return $this->html;
    }
}