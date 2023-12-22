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

    '/service/save' => 'ServiceController@save',
    '/service/delete/{id}' => 'ServiceController@delete',

    '/unavailable_datetime/save' => 'UnavailableDatetimeController@save',
    '/unavailable_datetime/delete/{id}' => 'UnavailableDatetimeController@delete',
];