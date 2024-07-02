<?php

session_start();

class AdminController extends RenderView
{
    public function index(): void
    {
        $isLogged = isset($_SESSION['user']);
        $isAdmin = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'];

        if (!$isLogged || !$isAdmin) {
            header('Location: ' . BASE_URL);
            exit;
        }

        $contactInfo = new ContactInfoModel();
        $allContactInfos = $contactInfo->allContactInfos()[0] ?? null;

        $this->loadView('templates/head', [
            'title' => 'Admin',
            'scripts' => [
                BASE_URL . "public/js/pages/admin.js"
            ]
        ]);
        $this->loadView('templates/header', [
            'isAuth' => $isLogged,
            'isAdm'  => $isLogged and $isAdmin,
            'class' => true
        ]);
        $this->loadView('admin');
        $this->loadView('templates/footer', [
            'contact_info' => $allContactInfos,
            'isAuth' => $isLogged,
            'isAdm'  => $isLogged and $isAdmin,
        ]);
    }
}
