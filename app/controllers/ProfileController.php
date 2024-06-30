<?php

session_start();

class ProfileController extends RenderView
{
    public function index()
    {
        $isLogged = isset($_SESSION['user']);
        $isAdmin = isset($_SESSION['isAdmin']);

        if ($isAdmin) {
            header('Location: ' . BASE_URL . 'admin');
            exit;
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
