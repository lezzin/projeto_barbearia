<?php

session_start();

class ProfileController extends RenderView
{
    public function index()
    {
        if ((isset($_SESSION['isAdmin'])) and $_SESSION['isAdmin']) {
            header('Location: ' . BASE_URL . 'admin');
        }

        $contactInfo = new ContactInfoModel();
        $allContactInfos = $contactInfo->allContactInfos()[0] ?? null;

        $this->loadView('templates/head', [
            'title' => 'Perfil',
            'scripts' => [
                BASE_URL . "public/js/pages/profile.js"
            ]
        ]);
        $this->loadView('templates/header', [
            'isAuth' => isset($_SESSION['user']),
            'isAdm'  => isset($_SESSION['user']) and $_SESSION['isAdmin'],
            'class' => true
        ]);
        $this->loadView('profile', [
            'userData' => $_SESSION['user'] ?? [],
        ]);
        $this->loadView('templates/footer', [
            'contact_info' => $allContactInfos,
            'isAuth' => isset($_SESSION['user']),
            'isAdm'  => isset($_SESSION['user']) and $_SESSION['isAdmin'],
        ]);
    }
}
