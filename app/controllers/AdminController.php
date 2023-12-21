<?php

session_start();

class AdminController extends RenderView
{
    public function index() {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $service = new ServiceModel();
        $allServices = $service->allServices();

        $this->loadView('admin', [
            'title' => 'Admin',
            'services' => $allServices,
        ]);
    }
}