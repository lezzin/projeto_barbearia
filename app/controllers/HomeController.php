<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ContactInfoModel;
use App\Models\ServiceModel;

class HomeController extends Controller
{
    public function index()
    {
        $isLogged = isset($_SESSION['user']);
        $isAdmin = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'];

        $allServices = ServiceModel::allServices();
        $allContactInfos = ContactInfoModel::allContactInfos()[0] ?? null;

        $this->loadView('templates/head', [
            'title' => 'Início',
            'css_links' => [
                "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
            ],
            'scripts' => [
                "https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js",
                config('app.base_url') . "public/js/pages/home.js"
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
