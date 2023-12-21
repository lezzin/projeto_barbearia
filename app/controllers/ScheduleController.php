<?php

session_start();

class ScheduleController extends RenderView {
    function index() {
        $service = new ServiceModel();
        $allServices = $service->allServices();
        
        $this->loadView('schedule', [
            'title' => 'Agendamento',
            'services' => $allServices,
        ]);
    }

    function get_unavailable_datetime() {
        $unavailableDatetime = new UnavailableDatetimeModel();
        $allUnavailableDatetimes = $unavailableDatetime->allUnavailableDatetimes();
        
        echo json_encode($allUnavailableDatetimes);
    }

    function add() {
        $insertStatus = insert("schedule", [
            "user" => $_POST["username"],
            "tel" => $_POST["tel"],
            "service_id" => $_POST["service"],
            "datetime" => $_POST["datetime"],
            "message" => $_POST["message"],
        ]);

        echo json_encode(["status" => $insertStatus]);
    }
}
