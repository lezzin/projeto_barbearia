<?php

session_start();

class ServiceController extends RenderView
{
    public function save()
    {
        if (isset($_POST['id']) and !empty($_POST['id'])) {
            $this->edit();
            return;
        }

        $this->create();
    }

    public function create()
    {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $service = new ServiceModel();
        $name = $_POST['name'];
        $price = $_POST['price'];

        if ($service->fetchByName($name)) {
            echo json_encode([
                "status" => 401,
                "message" => "Serviço já cadastrado!",
            ]);

            return;
        }


        if (!$service->create($name, $price)) {
            echo json_encode([
                "status" => 500,
                "message" => "Erro ao criar serviço.",
            ]);

            return;
        }

        echo json_encode([
            "status" => 200,
            "message" => "Serviço criado com sucesso!",
        ]);

        $msg['success'] = "";
    }


    public function edit()
    {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $service = new ServiceModel();

        $name = $_POST['name'];
        $price = $_POST['price'];
        $id = $_POST['id'];

        if ($service->update($name, $price, $id)) {
            echo json_encode([
                "status" => 200,
                "message" => "Serviço atualizado com sucesso!",
            ]);

            return;
        }

        echo json_encode([
            "status" => 500,
            "message" => "Desculpa, algo deu errado, tente mais tarde!",
        ]);
    }

    public function delete($id)
    {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $service = new ServiceModel();

        if ($service->delete($id[0])) {
            echo json_encode([
                "status" => 200,
                "message" => "Serviço deletado com sucesso!",
            ]);

            return;
        }

        echo json_encode([
            "status" => 500,
            "message" => "Erro ao deletar o serviço.",
        ]);
    }

    public function getAllServices()
    {
        $service = new ServiceModel();
        $allServices = $service->allServices();

        echo json_encode($allServices);
    }
}
