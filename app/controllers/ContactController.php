<?php

session_start();

class ContactController extends RenderView
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

        $contactInfo = new ContactInfoModel();

        if (sizeof($contactInfo->allContactInfos()[0]) > 0) {
            $msg['error'] = "Você pode ter somente uma informação de contato";
        } else {
            $email = $_POST['email'];
            $address = $_POST['address'];
            $tel = $_POST['tel'];
            $whatsapp = $_POST['whatsapp'];
    
            if ($contactInfo->create($email, $address, $tel, $whatsapp)) {
                $msg['success'] = "Contato criado com sucesso!";
            } else {
                $msg['error'] = "Erro ao criar contato.";
            }
        }

        echo json_encode($msg);
    }

    public function edit() {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $msg = [];
        
        $contactInfo = new ContactInfoModel();

        $email = $_POST['email'];
        $address = $_POST['address'];
        $tel = $_POST['tel'];
        $whatsapp = $_POST['whatsapp'];
        $id = $_POST['id'];

        if ($contactInfo->update($email, $address, $tel, $whatsapp, $id)) {
            $msg['success'] = "Contato atualizado com sucesso!";
        } else {
            $msg['error'] = "Desculpa, algo deu errado, tente mais tarde!";
        }

        echo json_encode($msg);
    }

    public function delete($id) {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $contactInfo = new ContactInfoModel();
        
        $msg = [];

        if ($contactInfo->delete($id[0])) {
            $msg['success'] = "Contato deletado com sucesso!";
        } else {
            $msg['error'] = "Erro ao deletar o contato!";
        }

        echo json_encode($msg);
    }

    public function getContactInfo() {
        $contactInfo = new ContactInfoModel();
        $allContactInfos = $contactInfo->allContactInfos()[0];

        echo json_encode($allContactInfos);
    }
}