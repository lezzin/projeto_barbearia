<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ContactInfoModel;
use App\Models\ScheduleModel;
use App\Models\ServiceModel;
use App\Traits\ResponseJson;
use Throwable;

class ScheduleController extends Controller
{
    use ResponseJson;

    public function index()
    {
        $isLogged = isset($_SESSION['user']);
        $isAdmin = isset($_SESSION['isAdmin']) && $_SESSION['isAdmin'];

        if (!$isLogged) {
            header('Location: ' . config('app.base_url') . 'login?redirect=schedule');
            exit;
        }

        if ($isAdmin) {
            header('Location: ' . config('app.base_url') . 'admin');
            exit;
        }

        $allServices = ServiceModel::allServices();
        $allContactInfos = ContactInfoModel::allContactInfos()[0] ?? null;

        $this->loadView('templates/head', [
            'title' => 'Agendamento',
            'scripts' => [
                config('app.base_url') . "public/js/pages/schedule.js"
            ]
        ]);
        $this->loadView('templates/header', [
            'isAuth' => isset($_SESSION['user']),
            'isAdm'  => isset($_SESSION['user']) and $_SESSION['isAdmin'],
        ]);
        $this->loadView('schedule', [
            'services' => $allServices,
            'userData' => $_SESSION['user'] ?? [],
        ]);
        $this->loadView('templates/footer', [
            'contact_info' => $allContactInfos,
            'isAuth' => isset($_SESSION['user']),
            'isAdm'  => isset($_SESSION['user']) and $_SESSION['isAdmin'],
        ]);
    }

    public function create()
    {
        // $unavailableDatetime = new UnavailableDatetimeModel();

        $user = $_POST["username"];
        $tel = $_POST["tel"];
        $email = $_POST["email"];
        $service_id = $_POST["service"];
        $datetime = $_POST["datetime"];
        $message = $_POST["message"];
        $user_id = $_POST["user_id"];

        try {
            ScheduleModel::create($user, $tel, $email, $service_id, $datetime, $message, $user_id);
            // $unavailableDatetime->create($datetime);
            return $this->jsonResponse(200, "Agendamento realizado com sucesso!");
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao criar agendamento", $th);
        }
    }

    public function updateStatus()
    {
        $status = $_POST["status"];
        $id = $_POST["id"];

        $schedule = new ScheduleModel();

        try {
            $schedule->updateStatus($status, $id);
            return $this->jsonResponse(200, "Status atualizado com sucesso!");
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao atualizar status.", $th);
        }
    }

    public function getAllSchedules()
    {
        $schedule = new ScheduleModel();

        try {
            $allSchedules = $schedule->allSchedules();
            return $this->jsonResponse(200, "Busca de agendamentos concluída com sucesso", $allSchedules);
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao buscar agendamentos.", $th);
        }
    }

    public function getSchedulesByUser()
    {
        $schedule = new ScheduleModel();

        try {
            $userSchedules = $schedule->fetchByUser($_SESSION['user']['id']);
            return $this->jsonResponse(200, "Busca de agendamentos concluída com sucesso", $userSchedules);
        } catch (Throwable $th) {
            return $this->internalErrorResponse("Erro ao buscar agendamentos.", $th);
        }
    }
}
