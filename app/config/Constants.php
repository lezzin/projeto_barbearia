<?php

$DBSettings = array(
    'DB_HOST' => '127.0.0.1',
    'DB_USER' => 'root',
    'DB_PASS' => '',
    'DB_NAME' => 'barbershop',
    'BASE_URL' => 'http://localhost/projetos/projeto_barbearia/'
);

foreach ($DBSettings as $constant => $value) {
    define($constant, $value);
}

define("PAGE_TITLE", "Barbershop");
