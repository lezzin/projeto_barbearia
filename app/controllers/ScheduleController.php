<?php

session_start();

class ScheduleController extends RenderView
{
    public function index()
    {
        if ((isset($_SESSION['isAdmin'])) and $_SESSION['isAdmin']) {
            header('Location: ' . BASE_URL . 'admin');
        }

        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'login?redirect=schedule');
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
        $unavailableDatetime = new UnavailableDatetimeModel();

        $user = $_POST["username"];
        $tel = $_POST["tel"];
        $email = $_POST["email"];
        $service_id = $_POST["service"];
        $datetime = $_POST["datetime"];
        $message = $_POST["message"];
        $user_id = $_POST["user_id"];

        if ($schedule->create($user, $tel, $email, $service_id, $datetime, $message, $user_id)) {
            echo json_encode([
                "status" => 200,
                "message" => "Agendamento realizado com sucesso!",
            ]);

            // $unavailableDatetime->create($datetime);
            return;
        }

        echo json_encode([
            "status" => 500,
            "message" => "Erro ao realizar agendamento. Tente novamente.",
        ]);
    }

    public function updateStatus()
    {
        $status = $_POST["status"];
        $id = $_POST["id"];

        $schedule = new ScheduleModel();

        if ($schedule->updateStatus($status, $id)) {
            echo json_encode([
                "status" => 200,
                "message" => "Status atualizado com sucesso!",
            ]);

            return;
        }
        
        echo json_encode([
            "status" => 500,
            "message" => "Erro ao atualizar status. Tente novamente.",
        ]);
    }

    public function getAllSchedules()
    {
        $schedule = new ScheduleModel();
        $allSchedules = $schedule->allSchedules();

        echo json_encode($allSchedules);
    }

    public function getSchedulesByUser()
    {
        $schedule = new ScheduleModel();
        $userSchedules = $schedule->fetchByUser($_SESSION['user']['id']);

        echo json_encode($userSchedules);
    }
}
