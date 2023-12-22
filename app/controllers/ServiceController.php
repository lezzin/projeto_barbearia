<?php

session_start();

class ServiceController extends RenderView
{
    public function save() {
        if(isset($_POST['id']) and !empty($_POST['id']) ) {
            $this->edit();
            return;
        } 
        
        $this->create();
    }
    
    public function create() {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $msg = [];

        $service = new ServiceModel();

        $name = $_POST['name'];
        $price = $_POST['price'];

        if ($service->create($name, $price)) {
            $msg['success'] = "Serviço criado com sucesso!";
        } else {
            $msg['error'] = "Erro ao criar serviço.";
        }

        echo json_encode($msg);
    }

    public function edit() {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $msg = [];

        $service = new ServiceModel();

        $name = $_POST['name'];
        $price = $_POST['price'];
        $id = $_POST['id'];

        if ($service->update($name, $price, $id)) {
            $msg['success'] = "Serviço atualizado com sucesso!";
        } else {
            $msg['error'] = "Desculpa, algo deu errado, tente mais tarde!";
        }

        echo json_encode($msg);
    }

    public function delete($id)
    {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $service = new ServiceModel();
        
        $msg = [];

        if ($service->delete($id[0])) {
            $msg['success'] = "Serviço deletado com sucesso!";
        } else {
            $msg['error'] = "Erro ao deletar o serviço!";
        }

        echo json_encode($msg);
    }

    public function getAllServices() {
        $service = new ServiceModel();
        $allServices = $service->allServices();

        echo json_encode($allServices);
    }
}