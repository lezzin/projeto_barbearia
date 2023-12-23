<?php

session_start();

class ScheduleController extends RenderView {
    public function index() {
        if ((isset($_SESSION['adm'])) and $_SESSION['adm']) {
            header('Location: ' . BASE_URL . 'admin') ;
        }

        $service = new ServiceModel();
        $allServices = $service->allServices();
        
        $this->loadView('schedule', [
            'title' => 'Agendamento',
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
        $service_id = $_POST["service"];
        $datetime = $_POST["datetime"];
        $message = $_POST["message"];

        if ($schedule->create($user, $tel, $service_id, $datetime, $message)) {
            $unavailableDatetime->create($datetime);
            $msg['success'] = "Agendamento realizado com sucesso!";
        } else {
            $msg['error'] = "Erro ao realizar agendamento. Tente novamente.";
        }

        echo json_encode($msg);
    }

    public function getAllSchedules(){
        $schedule = new ScheduleModel();
        $allSchedules = $schedule->allSchedules();

        echo json_encode($allSchedules);
    }
}