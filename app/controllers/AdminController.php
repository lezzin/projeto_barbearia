<?php

session_start();

class AdminController extends RenderView
{
    public function index() {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $service = new ServiceModel();
        $unavailableDatetime = new UnavailableDatetimeModel();

        $allServices = $service->allServices();
        $allUnavailableDatetimes = $unavailableDatetime->allUnavailableDatetimes();

        $this->loadView('admin', [
            'title' => 'Admin',
            'services' => $allServices,
            'unavailable_datetimes' => $allUnavailableDatetimes,
            'isAuth' => isset($_SESSION['user']),
        ]);
    }
}