<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ContactInfoModel;
use App\Models\UserModel;
use Throwable;

class UserController extends Controller
{
    public function login()
    {
        $allContactInfos = ContactInfoModel::allContactInfos()[0] ?? null;

        $this->loadView('templates/head', [
            'title' => 'Login',
            'scripts' => [
                config('app.base_url') . "public/js/pages/login.js"
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
        $allContactInfos = ContactInfoModel::allContactInfos()[0] ?? null;

        $this->loadView('templates/head', [
            'title' => 'Registro',
            'scripts' => [
                config('app.base_url') . "public/js/pages/register.js"
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
        header("Location: " . config('app.base_url') . "login");
    }

    public function verify()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'GET') {
            header('Location: ' . config('app.base_url') . 'login');
            exit;
        }

        $username = $_POST['username'];
        $password = $_POST['password'];

        try {
            $user = UserModel::login($username, $password);

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
                    "url" => config('app.base_url')
                ]
            ]);
        } catch (Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage(),
            ]);
        }
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

        try {
            $user->create($username, $email, $telephone, $password);
            echo json_encode([
                "status" => 200,
                "message" => "Usuário cadastrado com sucesso",
                "data" => [
                    "url" =>  config('app.base_url') . 'login'
                ]
            ]);
        } catch (Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage(),
            ]);
        }
    }
}
