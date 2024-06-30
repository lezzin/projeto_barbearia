<?php

session_start();

class ServiceController extends RenderView
{
    public function save()
    {
        if (isset($_POST['id']) and !empty($_POST['id'])) {
            $this->edit();
            exit;
        }

        $this->create();
    }

    public function create()
    {
        $service = new ServiceModel();
        $name = $_POST['name'];
        $price = $_POST['price'];

        if ($service->fetchByName($name)) {
            echo json_encode([
                "status" => 401,
                "message" => "Serviço já cadastrado!",
            ]);

            exit;
        }

        try {
            $service->create($name, $price);
            echo json_encode([
                "status" => 200,
                "message" => "Serviço criado com sucesso!",
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage(),
            ]);
        }
    }


    public function edit()
    {
        $service = new ServiceModel();

        $name = $_POST['name'];
        $price = $_POST['price'];
        $id = $_POST['id'];

        try {
            $service->update($name, $price, $id);
            echo json_encode([
                "status" => 200,
                "message" => "Serviço atualizado com sucesso!",
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage(),
            ]);
        }
    }

    public function delete($id)
    {
        $service = new ServiceModel();

        try {
            $service->delete($id[0]);
            echo json_encode([
                "status" => 200,
                "message" => "Serviço deletado com sucesso!",
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage(),
            ]);
        }
    }

    public function getAllServices()
    {
        $service = new ServiceModel();

        try {
            $allServices = $service->allServices();
            echo json_encode([
                "status" => 200,
                "message" => "Busca de informações de contato concluída com sucesso",
                "data" => $allServices
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage()
            ]);
        }
    }
}
