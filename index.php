<?php

require_once 'vendor/autoload.php';
require_once 'routes/web.php';

session_start();

$core = new \App\Core\Core($routes);
$core->run();
