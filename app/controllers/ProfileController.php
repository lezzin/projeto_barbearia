<?php

session_start();

class ProfileController extends RenderView
{
    public function index() {
        if ((isset($_SESSION['adm'])) and $_SESSION['adm']) {
            header('Location: ' . BASE_URL . 'admin') ;
        }
        
        $contactInfo = new ContactInfoModel();
        $allContactInfos = $contactInfo->allContactInfos()[0] ?? null;

        $this->loadView('profile', [
            'title' => 'Perfil',
            'contact_info' => $allContactInfos,
            'isAuth' => isset($_SESSION['user']),
            'isAdm' => isset($_SESSION['user']) and $_SESSION['adm'],
            'userData' => $_SESSION['user'] ?? [],
        ]);
    }
}