<?php

$routes = [
    '/' => 'HomeController@index',
    
    '/login' => 'HomeController@login',
    '/verify' => 'HomeController@verify',
    '/logout' => 'HomeController@logout',
    '/register' => 'HomeController@register',
    
    '/user/create' => 'UserController@create',
    
    '/schedule' => 'ScheduleController@index',
    '/schedule/create' => 'ScheduleController@create',
    '/schedule/get_all' => 'ScheduleController@getAllSchedules',
    
    '/admin' => 'AdminController@index',
    
    '/service/save' => 'ServiceController@save',
    '/service/delete/{id}' => 'ServiceController@delete',
    '/service/get_all' => 'ServiceController@getAllServices',
    
    '/unavailable_datetime/save' => 'UnavailableDatetimeController@save',
    '/unavailable_datetime/delete/{id}' => 'UnavailableDatetimeController@delete',
    '/unavailable_datetime/get_all' => 'UnavailableDatetimeController@getAllUnavailableDatetimes',
];