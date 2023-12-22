<?php

session_start();

class AdminController extends RenderView
{
    public function index() {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $this->loadView('admin', [
            'title' => 'Admin',
            'isAuth' => isset($_SESSION['user']),
        ]);
    }
}