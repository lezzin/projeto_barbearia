<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\UnavailableDatetimeModel;
use App\Traits\ResponseJson;
use Throwable;

class UnavailableDatetimeController extends Controller
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
        $date = $_POST['date'];
        $time = $_POST['time'];
        $datetime = $date . ' ' . $time;

        if (UnavailableDatetimeModel::fetchByDatetime($datetime)) {
            return $this->jsonResponse(401, "Data já cadastrada!");
        }

        try {
            UnavailableDatetimeModel::create($datetime);
            return $this->jsonResponse(200, "Data adicionada com sucesso!");
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao criar nova data.", $th);
        }
    }

    public function edit()
    {
        $date = $_POST['date'];
        $time = $_POST['time'];
        $datetime = $date . ' ' . $time;
        $id = $_POST['id'];

        try {
            UnavailableDatetimeModel::update($datetime, $id);
            return $this->jsonResponse(200, "Data editada com sucesso!");
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao editar data.", $th);
        }
    }

    public function delete($id)
    {
        try {
            UnavailableDatetimeModel::delete($id[0]);
            return $this->jsonResponse(200, "Data excluída com sucesso!");
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao excluir data.", $th);
        }
    }

    public function getAllUnavailableDatetimes()
    {
        try {
            $allUnavailableDatetimes = UnavailableDatetimeModel::allUnavailableDatetimes();
            return $this->jsonResponse(200, "Busca de horários concluída com sucesso!", $allUnavailableDatetimes);
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao buscar datas.", $th);
        }
    }
}
