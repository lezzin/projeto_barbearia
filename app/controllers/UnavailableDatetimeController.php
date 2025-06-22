<?php

namespace App\Controllers;

use App\Core\Controller;

class UnavailableDatetimeController extends Controller
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
        $unavailableDatetime = new UnavailableDatetimeModel();

        $date = $_POST['date'];
        $time = $_POST['time'];
        $datetime = $date . ' ' . $time;

        if ($unavailableDatetime->fetchByDatetime($datetime)) {
            echo json_encode([
                "status" => 401,
                "message" => "Data já cadastrada!",
            ]);

            exit;
        }

        try {
            $unavailableDatetime->create($datetime);
            echo json_encode([
                "status" => 200,
                "message" => "Data adicionada com sucesso",
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
        $unavailableDatetime = new UnavailableDatetimeModel();

        $date = $_POST['date'];
        $time = $_POST['time'];
        $datetime = $date . ' ' . $time;
        $id = $_POST['id'];

        try {
            $unavailableDatetime->update($datetime, $id);
            echo json_encode([
                "status" => 200,
                "message" => "Data editada com sucesso",
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
        $unavailableDatetime = new UnavailableDatetimeModel();

        try {
            $unavailableDatetime->delete($id[0]);
            echo json_encode([
                "status" => 200,
                "message" => "Data deletada com sucesso",
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage(),
            ]);
        }
    }

    public function getAllUnavailableDatetimes()
    {
        $unavailableDatetime = new UnavailableDatetimeModel();

        try {
            $allUnavailableDatetimes = $unavailableDatetime->allUnavailableDatetimes();
            echo json_encode([
                "status" => 200,
                "message" => "Busca de horários concluída com sucesso",
                "data" => $allUnavailableDatetimes
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage()
            ]);
        }
    }
}
