<?php

class RenderView {
    public function loadView($view, $args = null) {
        if($args) {
            extract($args);
        }
        
        require_once __DIR__ . "/../views/$view.php";
    }
}