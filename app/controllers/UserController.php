<?php

session_start();

class UserController extends RenderView
{
    public function create() {
        $msg = [];
        
        $user = new UserModel();

        $username = $_POST["username"];
        $tel = $_POST["tel"];
        $password = password_hash($_POST["password"], PASSWORD_BCRYPT);

        if ($user->create($username, $tel, $password)) {
            $msg['success'] = "Usuário criado com sucesso!";
            $msg['url'] = BASE_URL . 'login';
        } else {
            $msg['error'] = "Erro ao realizar cadastro. Tente novamente.";
        }

        echo json_encode($msg);
    }
}