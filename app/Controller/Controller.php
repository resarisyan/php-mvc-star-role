<?php

namespace StarRole\PhpMvc\Controller;

class Controller
{
    public function view($view, $data = [])
    {
        extract($data);
        require_once __DIR__ . "/../View/$view.php";
    }
}
