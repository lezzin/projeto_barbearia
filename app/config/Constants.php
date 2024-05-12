<?php

$developmentTypes = array(
    "local" => "local",
    "host"  => "host"
);

$development = $developmentTypes["local"];

$localDBSettings = array(
    'DB_HOST' => '127.0.0.1',
    'DB_USER' => 'root',
    'DB_PASS' => '',
    'DB_NAME' => 'barbershop',
    'BASE_URL' => 'http://localhost/projetos/projeto_barbearia/'
);

$hostDBSettings = array(
    'DB_HOST' => 'localhost',
    'DB_USER' => 'id21709051_lzzn',
    'DB_PASS' => 'Barbearia#3690',
    'DB_NAME' => 'id21709051_lzzn_barber',
    'BASE_URL' => 'https://lzzn-barber.000webhostapp.com/'
);

$DBSettings = ($development == $developmentTypes["local"]) ? $localDBSettings : $hostDBSettings;

foreach ($DBSettings as $constant => $value) {
    define($constant, $value);
}

define("PAGE_TITLE", "Barbershop");
