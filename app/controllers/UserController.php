<?php

session_start();

class UserController extends RenderView
{
    public function login()
    {
        if ((isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL);
        }

        $contactInfo = new ContactInfoModel();
        $allContactInfos = $contactInfo->allContactInfos()[0] ?? null;

        $this->loadView('templates/head', [
            'title' => 'Login',
            'scripts' => [
                BASE_URL . "public/js/pages/login.js"
            ]
        ]);
        $this->loadView('templates/header', [
            'isAuth' => isset($_SESSION['user']),
            'isAdm'  => isset($_SESSION['user']) and $_SESSION['isAdmin'],
            'class' => true
        ]);
        $this->loadView('login');
        $this->loadView('templates/footer', [
            'contact_info' => $allContactInfos,
            'isAuth' => isset($_SESSION['user']),
            'isAdm'  => isset($_SESSION['user']) and $_SESSION['isAdmin'],
        ]);
    }

    public function register()
    {
        $contactInfo = new ContactInfoModel();
        $allContactInfos = $contactInfo->allContactInfos()[0] ?? null;

        $this->loadView('templates/head', [
            'title' => 'Registro',
            'scripts' => [
                BASE_URL . "public/js/pages/register.js"
            ]
        ]);
        $this->loadView('templates/header', [
            'isAuth' => isset($_SESSION['user']),
            'isAdm'  => isset($_SESSION['user']) and $_SESSION['isAdmin'],
            'class' => true
        ]);
        $this->loadView('register');
        $this->loadView('templates/footer', [
            'contact_info' => $allContactInfos,
            'isAuth' => isset($_SESSION['user']),
            'isAdm'  => isset($_SESSION['user']) and $_SESSION['isAdmin'],
        ]);
    }

    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['isAdmin']);
        header("Location: " . BASE_URL . "login");
    }

    public function verify()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . BASE_URL . 'login');
            exit;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        $userModel = new UserModel();
        $user = $userModel->login($username, $password);

        if (!$user) {
            echo json_encode([
                "status" => 401,
                "message" => "Usuário não encontrado"
            ]);

            exit;
        }

        $_SESSION['user'] = $user;
        $_SESSION['isAdmin'] = $user["type"] == 2;

        echo json_encode([
            "status" => 200,
            "message" => "Usuário autenticado com sucesso!",
            "data" => [
                "url" => BASE_URL
            ]
        ]);
    }

    public function create()
    {
        $user = new UserModel();
        $email = $_POST["email"];
        $username = $_POST["username"];

        if ($user->fetchByEmail($email) || $user->fetchByName($username)) {
            echo json_encode([
                "status" => 401,
                "message" => "Usuário já cadastrado!",
            ]);

            exit;
        }

        $telephone = $_POST["tel"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        if (!$user->create($username, $email, $telephone, $password)) {
            echo json_encode([
                "status" => 500,
                "message" => "Erro ao realizar cadastro. Tente novamente.!",
            ]);
            
            exit;
        }
        
        echo json_encode([
            "status" => 200,
            "message" => "Usuário criado com sucesso",
            "data" => [
                "url" =>  BASE_URL . 'login'
            ]
        ]);
    }
}
