<?php

session_start();

class UnavailableDatetimeController extends RenderView
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
        $unavailableDatetime = new UnavailableDatetimeModel();

        $date = $_POST['date'];
        $time = $_POST['time'];
        $datetime = $date . ' ' . $time;

        if ($unavailableDatetime->fetchByDatetime($datetime)) {
            echo json_encode([
                "status" => 401,
                "message" => "Data já cadastrada!",
            ]);

            return;
        }

        if (!$unavailableDatetime->create($datetime)) {
            echo json_encode([
                "status" => 500,
                "message" => "Erro ao adicionar data",
            ]);

            return;
        }

        echo json_encode([
            "status" => 200,
            "message" => "Data adicionada com sucesso",
        ]);
    }

    public function edit()
    {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $unavailableDatetime = new UnavailableDatetimeModel();

        $date = $_POST['date'];
        $time = $_POST['time'];
        $datetime = $date . ' ' . $time;
        $id = $_POST['id'];

        if (!$unavailableDatetime->update($datetime, $id)) {
            echo json_encode([
                "status" => 500,
                "message" => "Desculpa, algo deu errado, tente mais tarde!",
            ]);

            return;
        }

        echo json_encode([
            "status" => 200,
            "message" => "Data editada com sucesso",
        ]);
    }

    public function delete($id)
    {
        if ((!isset($_SESSION['user']))) {
            header('Location: ' . BASE_URL . 'login');
        }

        $unavailableDatetime = new UnavailableDatetimeModel();

        if (!$unavailableDatetime->delete($id[0])) {
            echo json_encode([
                "status" => 500,
                "message" => "Desculpa, algo deu errado, tente mais tarde!",
            ]);
            
            return;
        }
        
        echo json_encode([
            "status" => 200,
            "message" => "Data deletada com sucesso!",
        ]);
    }

    public function getAllUnavailableDatetimes()
    {
        $unavailableDatetime = new UnavailableDatetimeModel();
        $allUnavailableDatetimes = $unavailableDatetime->allUnavailableDatetimes();

        echo json_encode($allUnavailableDatetimes);
    }
}
