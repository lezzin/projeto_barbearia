<?php

session_start();

class HomeController extends RenderView
{
    public function index()
    {
        $service = new ServiceModel();
        $allServices = $service->allServices();

        $contactInfo = new ContactInfoModel();
        $allContactInfos = $contactInfo->allContactInfos()[0] ?? null;

        $this->loadView('templates/head', [
            'title' => 'Início',
            'css_links' => [
                "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
            ],
            'scripts' => [
                "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js",
                BASE_URL . "public/js/pages/home.js"
            ]
        ]);
        $this->loadView('templates/header', [
            'isAuth' => isset($_SESSION['user']),
            'isAdm'  => isset($_SESSION['user']) and $_SESSION['isAdmin'],
        ]);
        $this->loadView('home', [
            'services' => $allServices,
            'isAdm'  => isset($_SESSION['user']) and $_SESSION['isAdmin'],
        ]);
        $this->loadView('templates/footer', [
            'contact_info' => $allContactInfos,
            'isAuth' => isset($_SESSION['user']),
            'isAdm'  => isset($_SESSION['user']) and $_SESSION['isAdmin'],
        ]);
    }
}
