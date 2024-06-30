<?php

use function PHPSTORM_META\map;

session_start();

class ScheduleController extends RenderView
{
    public function index()
    {
        $isLogged = isset($_SESSION['user']);
        $isAdmin = isset($_SESSION['isAdmin']);

        if (!$isLogged) {
            header('Location: ' . BASE_URL . 'login?redirect=schedule');
            exit;
        }

        if ($isAdmin) {
            header('Location: ' . BASE_URL . 'admin');
            exit;
        }

        $contactInfo = new ContactInfoModel();
        $service = new ServiceModel();

        $allServices = $service->allServices();
        $allContactInfos = $contactInfo->allContactInfos()[0] ?? null;

        $this->loadView('templates/head', [
            'title' => 'Agendamento',
            'scripts' => [
                BASE_URL . "public/js/pages/schedule.js"
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
        $schedule = new ScheduleModel();
        // $unavailableDatetime = new UnavailableDatetimeModel();

        $user = $_POST["username"];
        $tel = $_POST["tel"];
        $email = $_POST["email"];
        $service_id = $_POST["service"];
        $datetime = $_POST["datetime"];
        $message = $_POST["message"];
        $user_id = $_POST["user_id"];

        try {
            $schedule->create($user, $tel, $email, $service_id, $datetime, $message, $user_id);
            // $unavailableDatetime->create($datetime);
            echo json_encode([
                "status" => 200,
                "message" => "Agendamento realizado com sucesso!",
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function updateStatus()
    {
        $status = $_POST["status"];
        $id = $_POST["id"];

        $schedule = new ScheduleModel();

        try {
            $schedule->updateStatus($status, $id);
            echo json_encode([
                "status" => 200,
                "message" => "Status atualizado com sucesso!",
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function getAllSchedules()
    {
        $schedule = new ScheduleModel();

        try {
            $allSchedules = $schedule->allSchedules();
            echo json_encode([
                "status" => 200,
                "message" => "Busca de agendamentos concluída com sucesso",
                "data" => $allSchedules
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage()
            ]);
        }
    }

    public function getSchedulesByUser()
    {
        $schedule = new ScheduleModel();

        try {
            $userSchedules = $schedule->fetchByUser($_SESSION['user']['id']);
            echo json_encode([
                "status" => 200,
                "message" => "Busca de agendamentos concluída com sucesso",
                "data" => $userSchedules
            ]);
        } catch (\Throwable $th) {
            echo json_encode([
                "status" => 500,
                "message" => $th->getMessage()
            ]);
        }
    }
}
