<?php

session_start();

class ScheduleController extends RenderView {
    public function index() {
        if ((isset($_SESSION['adm'])) and $_SESSION['adm']) {
            header('Location: ' . BASE_URL . 'admin') ;
        }

        if (!isset($_SESSION['user'])) {
            header('Location: ' . BASE_URL . 'login?redirect=schedule') ;
        }

        $contactInfo = new ContactInfoModel();
        $service = new ServiceModel();
        
        $allServices = $service->allServices();
        $allContactInfos = $contactInfo->allContactInfos()[0];
        
        $this->loadView('schedule', [
            'title' => 'Agendamento',
            'contact_info' => $allContactInfos,
            'services' => $allServices,
            'isAuth' => isset($_SESSION['user']),
            'isAdm' => isset($_SESSION['user']) and $_SESSION['adm'],
            'userData' => $_SESSION['user'] ?? [],
        ]);
    }

    public function create() {
        $msg = [];
        
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
            $msg['success'] = "Agendamento realizado com sucesso!";
            // $unavailableDatetime->create($datetime);
        } else {
            $msg['error'] = "Erro ao realizar agendamento. Tente novamente.";
        }

        echo json_encode($msg);
    }

    public function updateStatus() {
        $msg = [];

        $status = $_POST["status"];
        $id = $_POST["id"];

        $schedule = new ScheduleModel();

        if ($schedule->updateStatus($status, $id)) {
            $msg['success'] = "Status atualizado com sucesso!";
        } else {
            $msg['error'] = "Erro ao atualizar status. Tente novamente.";
        }

        echo json_encode($msg);
    }

    public function getAllSchedules(){
        $schedule = new ScheduleModel();
        $allSchedules = $schedule->allSchedules();

        echo json_encode($allSchedules);
    }

    public function getSchedulesByUser(){
        $schedule = new ScheduleModel();
        $userSchedules = $schedule->fetchByUser($_SESSION['user']['id']);

        echo json_encode($userSchedules);
    }
}