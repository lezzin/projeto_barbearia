<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ServiceModel;

class ServiceController extends Controller
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
        $name = $_POST['name'];
        $price = $_POST['price'];

        if (ServiceModel::fetchByName($name)) {
            echo json_encode([
                "status" => 401,
                "message" => "Serviço já cadastrado!",
            ]);

            exit;
        }

        try {
            ServiceModel::create($name, $price);
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
        $name = $_POST['name'];
        $price = $_POST['price'];
        $id = $_POST['id'];

        try {
            ServiceModel::update($name, $price, $id);
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
            ServiceModel::delete($id[0]);
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
        try {
            $allServices = ServiceModel::allServices();

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
