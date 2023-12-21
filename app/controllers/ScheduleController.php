<?php

session_start();

class ScheduleController extends RenderView {
    public function index() {
        $service = new ServiceModel();
        $allServices = $service->allServices();
        
        $this->loadView('schedule', [
            'title' => 'Agendamento',
            'services' => $allServices,
        ]);
    }

    public function get_unavailable_datetime() {
        $unavailableDatetime = new UnavailableDatetimeModel();
        $allUnavailableDatetimes = $unavailableDatetime->allUnavailableDatetimes();
        
        echo json_encode($allUnavailableDatetimes);
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
}
