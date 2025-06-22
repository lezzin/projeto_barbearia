<?php

namespace App\Core;

class Controller
{
    public function loadView(string $view, ?array $args = null): void
    {
        if ($args) extract($args);
        require_once __DIR__ . "/../views/$view.php";
    }
}
