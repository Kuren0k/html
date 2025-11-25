<?php

namespace App\Views;

class FrontView
{
    public function __construct()
    {

    }

    public function render($content, $data=[])
    {
        include $content;
    }

}