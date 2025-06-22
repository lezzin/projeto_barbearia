<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ContactInfoModel;
use App\Models\UserModel;
use App\Traits\ResponseJson;
use Throwable;

class UserController extends Controller
{
    use ResponseJson;

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
                return $this->jsonResponse(401, "Usuário não encontrado.");
            }

            $_SESSION['user'] = $user;
            $_SESSION['isAdmin'] = $user["type"] == 2;

            $data = ["url" => config('app.base_url')];
            return $this->jsonResponse(200, "Usuário autenticado com sucesso.", $data);
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao autenticar usuário.", $th);
        }
    }

    public function create()
    {
        $user = new UserModel();
        $email = $_POST["email"];
        $username = $_POST["username"];

        if ($user->fetchByEmail($email) || $user->fetchByName($username)) {
            return $this->jsonResponse(200, "Usuário já cadastrado!");
        }

        $telephone = $_POST["tel"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        try {
            $user->create($username, $email, $telephone, $password);

            $data =  ["url" =>  config('app.base_url') . 'login'];
            return $this->jsonResponse(200, "Usuário cadastrado com sucesso!", $data);
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao autenticar usuário.", $th);
        }
    }
}
