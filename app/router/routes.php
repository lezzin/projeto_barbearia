<?php

$routes = [
    '/' => 'HomeController@index',
    
    '/login' => 'HomeController@login',
    '/verify' => 'HomeController@verify',
    '/logout' => 'HomeController@logout',
    
    '/schedule' => 'ScheduleController@index',
    '/schedule/create' => 'ScheduleController@create',
    '/schedule/get_unavailable_datetime' => 'ScheduleController@get_unavailable_datetime',

    '/admin' => 'AdminController@index',

    '/service/create' => 'ServiceController@create',
    '/service/edit/{id}' => 'ServiceController@edit',
    '/service/delete/{id}' => 'ServiceController@delete',
    '/service/update' => 'ServiceController@update',

    '/unavailable_datetime/create' => 'UnavailableDatetimeController@create',
    '/unavailable_datetime/delete/{id}' => 'UnavailableDatetimeController@delete',
];