<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ContactInfoModel;

class ProfileController extends Controller
{
    public function index()
    {
        $isLogged = isset($_SESSION['user']);
        $isAdmin = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'];

        if ($isAdmin) {
            header('Location: ' . config('app.base_url') . 'admin');
            exit;
        }

        $allContactInfos = ContactInfoModel::allContactInfos()[0] ?? null;

        $this->loadView('templates/head', [
            'title' => 'Perfil',
            'scripts' => [
                config('app.base_url') . "public/js/pages/profile.js"
            ]
        ]);
        $this->loadView('templates/header', [
            'isAuth' => $isLogged,
            'isAdm'  => $isLogged and $isAdmin,
            'class' => true
        ]);
        $this->loadView('profile', [
            'userData' => $_SESSION['user'] ?? [],
        ]);
        $this->loadView('templates/footer', [
            'contact_info' => $allContactInfos,
            'isAuth' => $isLogged,
            'isAdm'  => $isLogged and $isAdmin,
        ]);
    }
}
