<?php

session_start();

class HomeController extends RenderView
{
    public function index() {
        $service = new ServiceModel();
        $allServices = $service->allServices();

        $this->loadView('home', [
            'title' => 'Home',
            'services' => $allServices,
            'isAuth' => isset($_SESSION['user']),
        ]);
    }

    public function login() {
        $this->loadView('login', [
            'title' => 'Login'
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
        } else {
            $msg['error'] = "Usuário não autenticado!";
        }
    
        echo json_encode($msg);
    }
}