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
        $contactInfo = new ContactInfoModel();
        $isAlreadyCountainsInfo = sizeof($contactInfo->allContactInfos()) > 0;

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
            $contactInfo->create($email, $address, $tel, $whatsapp);
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
        $contactInfo = new ContactInfoModel();

        $email = $_POST['email'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        $whatsapp = $_POST['whatsapp'];
        $id = $_POST['id'];

        try {
            $contactInfo->update($email, $address, $tel, $whatsapp, $id);
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
        $contactInfo = new ContactInfoModel();

        try {
            $contactInfo->delete($id[0]);

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
        $contactInfo = new ContactInfoModel();

        try {
            $allContactInfos = $contactInfo->allContactInfos();
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
