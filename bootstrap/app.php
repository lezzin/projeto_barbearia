<?php

require_once __DIR__ . '/helpers.php';

use App\Core\Logger;

function logger(): Logger
{
    static $logger = null;

    if ($logger === null) {
        $logger = Logger::getInstance('logs/app.log');
    }

    return $logger;
}
