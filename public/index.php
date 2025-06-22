<?php

use Dotenv\Dotenv;

session_start();

require_once dirname(__DIR__) . '/vendor/autoload.php';
require_once dirname(__DIR__) . '/routes/web.php';

$dotenv = Dotenv::createImmutable(dirname(__DIR__));
$dotenv->load();

$core = new \App\Core\Core($routes);
$core->run();
