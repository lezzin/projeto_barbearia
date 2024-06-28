<?php

$mode = 'dev';

define('DB_HOST', '127.0.0.1');
define('DB_USER', $mode === 'dev' ? 'root' : 'id21709051_lzzn');
define('DB_PASS', $mode === 'dev' ? '' : 'Barbearia#3690');
define('DB_NAME', $mode === 'dev' ? 'barbershop' : 'id21709051_lzzn_barber');
define('BASE_URL', $mode === 'dev' ? 'http://localhost/projetos/projeto_barbearia/' : 'https://lzzn-barber.000webhostapp.com/');

define('PAGE_TITLE', 'Barbearia');
