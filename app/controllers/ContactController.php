<?php

session_start();

class ContactController extends RenderView
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

        $contactInfo = new ContactInfoModel();

        if (sizeof($contactInfo->allContactInfos()) > 0) {
            echo json_encode([
                "status" => 401,
                "message" => "Você pode ter somente uma informação de contato"
            ]);

            exit;
        }

        $email = $_POST['email'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        $whatsapp = $_POST['whatsapp'];

        if (!$contactInfo->create($email, $address, $tel, $whatsapp)) {
            echo json_encode([
                "status" => 500,
                "message" => "Erro ao criar contato"
            ]);

            exit;
        }

        echo json_encode([
            "status" => 200,
            "message" => "Contato criado com sucesso!"
        ]);
    }

    public function edit()
    {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $contactInfo = new ContactInfoModel();

        $email = $_POST['email'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        $whatsapp = $_POST['whatsapp'];
        $id = $_POST['id'];

        if (!$contactInfo->update($email, $address, $tel, $whatsapp, $id)) {
            echo json_encode([
                "status" => 500,
                "message" => "Desculpa, algo deu errado, tente mais tarde!"
            ]);

            exit;
        }

        echo json_encode([
            "status" => 200,
            "message" => "Contato atualizado com sucesso!"
        ]);
    }

    public function delete($id)
    {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $contactInfo = new ContactInfoModel();

        if (!$contactInfo->delete($id[0])) {
            echo json_encode([
                "status" => 500,
                "message" => "Erro ao deletar o contato"
            ]);

            exit;
        }

        echo json_encode([
            "status" => 200,
            "message" => "Contato deletado com sucesso!"
        ]);
    }

    public function getContactInfo()
    {
        $contactInfo = new ContactInfoModel();
        $allContactInfos = $contactInfo->allContactInfos();

        echo json_encode($allContactInfos);
    }
}
