<?php

session_start();

class UnavailableDatetimeController extends RenderView  {
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

        $unavailableDatetime = new UnavailableDatetimeModel();

        $date = $_POST['date'];
        $time = $_POST['time'];
        $datetime = $date . ' ' . $time;

        if ($unavailableDatetime->fetchByDatetime($datetime)) {
            $msg['error'] = "Data já cadastrada!";
        } else {
            if ($unavailableDatetime->create($datetime)) {
                $msg['success'] = "Data adicionada com sucesso!";
            } else {
                $msg['error'] = "Erro ao adicionar data.";
            }
        }

        echo json_encode($msg);
    }

    public function edit() {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }
        
        $msg = [];

        $unavailableDatetime = new UnavailableDatetimeModel();

        $date = $_POST['date'];
        $time = $_POST['time'];
        $datetime = $date . ' ' . $time;        
        $id = $_POST['id'];

        if ($unavailableDatetime->update($datetime, $id)) {
            $msg['success'] = "Data atualizada com sucesso!";
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

        $unavailableDatetime = new UnavailableDatetimeModel();
        
        $msg = [];

        if ($unavailableDatetime->delete($id[0])) {
            $msg['success'] = "Data deletada com sucesso!";
        } else {
            $msg['error'] = "Erro ao deletar a data!";
        }

        echo json_encode($msg);
    }

    public function getAllUnavailableDatetimes() {
        $unavailableDatetime = new UnavailableDatetimeModel();
        $allUnavailableDatetimes = $unavailableDatetime->allUnavailableDatetimes();

        echo json_encode($allUnavailableDatetimes);
    }
}