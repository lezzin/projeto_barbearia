<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ContactInfoModel;
use App\Traits\ResponseJson;
use Throwable;

class ContactController extends Controller
{
    use ResponseJson;

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
            return $this->jsonResponse(401, "Você pode ter somente uma informação de contato");
        }

        $email = $_POST['email'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        $whatsapp = $_POST['whatsapp'];

        try {
            ContactInfoModel::create($email, $address, $tel, $whatsapp);
            return $this->jsonResponse(200, "Contato criado com sucesso!");
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao concluir solicitação.", $th);
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
            return $this->jsonResponse(200, "Contato atualizado com sucesso!");
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao atualizar contato.", $th);
        }
    }

    public function delete($id)
    {
        try {
            ContactInfoModel::delete($id[0]);
            return $this->jsonResponse(200, "Contato excluído com sucesso!");
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao excluir contato.", $th);
        }
    }

    public function getContactInfo()
    {
        try {
            $allContactInfos = ContactInfoModel::allContactInfos();
            return $this->jsonResponse(200, "Busca de informações de contato concluída com sucesso", $allContactInfos);
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao buscar informações de contato.", $th);
        }
    }
}
