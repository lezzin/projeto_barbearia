<?php

session_start();

class AdminController extends RenderView
{
    public function index() {
        if ((!isset($_SESSION['user'])) || !$_SESSION['adm']) {
            header('Location: ' . BASE_URL) ;
        }

        $this->loadView('admin', [
            'title' => 'Admin',
            'isAuth' => isset($_SESSION['user']),
            'isAdm' => isset($_SESSION['user']) and $_SESSION['adm'],
        ]);
    }
}