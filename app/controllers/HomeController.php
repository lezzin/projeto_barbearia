<?php

session_start();

class HomeController extends RenderView
{
    public function index() {
        $service = new ServiceModel();
        $contactInfo = new ContactInfoModel();

        $allServices = $service->allServices();
        $allContactInfos = $contactInfo->allContactInfos()[0];

        $this->loadView('home', [
            'title' => 'Home',
            'contact_info' => $allContactInfos,
            'services' => $allServices,
            'isAuth' => isset($_SESSION['user']),
            'isAdm' => isset($_SESSION['user']) and $_SESSION['adm'],
        ]);
    }

    public function login() {
        if ((isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL);
        }

        $this->loadView('login', [
            'title' => 'Login'
        ]);
    }

    public function register() {
        $this->loadView('register', [
            'title' => 'Registro'
        ]);
    }

    public function logout() {
      unset($_SESSION['user']);
      header("Location: " . BASE_URL . "login");
    }

    public function verify() {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . BASE_URL . 'login');
        }
    
        $msg = [];
        $userModel = new UserModel();
    
        $username = $_POST['username'];
        $passwd = $_POST['password'];

        $user = $userModel->login($username, $passwd);

        if ($user) {
            $msg['success'] = "Usuário autenticado com sucesso!";
            $msg['url'] = BASE_URL;
            $_SESSION['user'] = $user;
            $_SESSION['adm'] = $user["type"] == 2;
        } else {
            $msg['error'] = "Usuário não autenticado!";
        }
    
        echo json_encode($msg);
    }
}