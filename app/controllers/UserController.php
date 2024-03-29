<?php

session_start();

class UserController extends RenderView
{
    
    public function login() {
        if ((isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL);
        }

        $contactInfo = new ContactInfoModel();
        $allContactInfos = $contactInfo->allContactInfos()[0] ?? null;

        $this->loadView('login', [
            'title' => 'Login',
            'contact_info' => $allContactInfos,
        ]);
    }

    public function register() {
        $contactInfo = new ContactInfoModel();
        $allContactInfos = $contactInfo->allContactInfos()[0] ?? null;

        $this->loadView('register', [
            'title' => 'Registro',
            'contact_info' => $allContactInfos,
        ]);
    }

    public function logout() {
      unset($_SESSION['user']);
      unset($_SESSION['adm']);
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
    
    public function create() {
        $msg = [];
        $user = new UserModel();
        $email = $_POST["email"];
        $username = $_POST["username"];

        if ($user->fetchByEmail($email) || $user->fetchByName($username)) {
            $msg['error'] = "Usuário já cadastrado!";
        } else {
            $tel = $_POST["tel"];
            $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

            if ($user->create($username, $email, $tel, $password)) {
                $msg['success'] = "Usuário criado com sucesso!";
                $msg['url'] = BASE_URL . 'login';
            } else {
                $msg['error'] = "Erro ao realizar cadastro. Tente novamente.";
            }
        }

        echo json_encode($msg);
    }
}