<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ServiceModel;
use App\Traits\ResponseJson;
use Throwable;

class ServiceController extends Controller
{
    use ResponseJson;

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
            return $this->jsonResponse(200, "Serviço criado com sucesso!");
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao criar novo serviço.", $th);
        }
    }

    public function edit()
    {
        $name = $_POST['name'];
        $price = $_POST['price'];
        $id = $_POST['id'];

        try {
            ServiceModel::update($name, $price, $id);
            return $this->jsonResponse(200, "Serviço atualizado com sucesso!");
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao atualizar serviço.", $th);
        }
    }

    public function delete($id)
    {
        try {
            ServiceModel::delete($id[0]);
            return $this->jsonResponse(200, "Serviço excluído com sucesso!");
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao excluir serviço.", $th);
        }
    }

    public function getAllServices()
    {
        try {
            $allServices = ServiceModel::allServices();
            return $this->jsonResponse(200, "Busca de serviços concluída com sucesso!", $allServices);
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao buscar serviços.", $th);
        }
    }
}
