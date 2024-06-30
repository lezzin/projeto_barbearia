<?php

session_start();

class HomeController extends RenderView
{
    public function index()
    {
        $isLogged = isset($_SESSION['user']);
        $isAdmin = isset($_SESSION['isAdmin']);

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
            'isAuth' => $isLogged,
            'isAdm'  => $isLogged and $isAdmin,
        ]);
        $this->loadView('home', [
            'services' => $allServices,
            'isAdm'  => $isLogged and $isAdmin,
        ]);
        $this->loadView('templates/footer', [
            'contact_info' => $allContactInfos,
            'isAuth' => $isLogged,
            'isAdm'  => $isLogged and $isAdmin,
        ]);
    }
}
