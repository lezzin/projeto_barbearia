<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ContactInfoModel;

class ContactController extends Controller
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
        $isAlreadyCountainsInfo = sizeof(ContactInfoModel::allContactInfos()) > 0;

        if ($isAlreadyCountainsInfo) {
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

        try {
            ContactInfoModel::create($email, $address, $tel, $whatsapp);
            echo json_encode([
                "status" => 200,
                "message" => "Contato criado com sucesso!"
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function edit()
    {
        $email = $_POST['email'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        $whatsapp = $_POST['whatsapp'];
        $id = $_POST['id'];

        try {
            ContactInfoModel::update($email, $address, $tel, $whatsapp, $id);
            echo json_encode([
                "status" => 200,
                "message" => "Contato atualizado com sucesso!"
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function delete($id)
    {
        try {
            ContactInfoModel::delete($id[0]);

            echo json_encode([
                "status" => 200,
                "message" => "Contato deletado com sucesso!"
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function getContactInfo()
    {
        try {
            $allContactInfos = ContactInfoModel::allContactInfos();
            echo json_encode([
                "status" => 200,
                "message" => "Busca de informações de contato concluída com sucesso",
                "data" => $allContactInfos
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage()
            ]);
        }
    }
}
