<?php

session_start();

class HomeController extends RenderView
{
    public function index() {
        $service = new ServiceModel();
        $allServices = $service->allServices();

        $contactInfo = new ContactInfoModel();
        $allContactInfos = $contactInfo->allContactInfos()[0] ?? null;

        $this->loadView('home', [
            'title' => 'Home',
            'contact_info' => $allContactInfos,
            'services' => $allServices,
            'isAuth' => isset($_SESSION['user']),
            'isAdm' => isset($_SESSION['user']) and $_SESSION['adm'],
        ]);
    }
}