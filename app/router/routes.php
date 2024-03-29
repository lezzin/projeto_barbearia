<?php

$routes = [
    '/' => 'HomeController@index',
    
    '/login' => 'UserController@login',
    '/verify' => 'UserController@verify',
    '/logout' => 'UserController@logout',
    '/register' => 'UserController@register',

    '/contact/save' => 'ContactController@save',
    '/contact/delete/{id}' => 'ContactController@delete',
    '/contact/get_all' => 'ContactController@getContactInfo',
    
    '/user/create' => 'UserController@create',
    
    '/schedule' => 'ScheduleController@index',
    '/schedule/create' => 'ScheduleController@create',
    '/schedule/get_all' => 'ScheduleController@getAllSchedules',
    '/schedule/get_by_user' => 'ScheduleController@getSchedulesByUser',
    '/schedule/update_status' => 'ScheduleController@updateStatus',
    
    '/admin' => 'AdminController@index',

    '/profile' => 'ProfileController@index',
    
    '/service/save' => 'ServiceController@save',
    '/service/delete/{id}' => 'ServiceController@delete',
    '/service/get_all' => 'ServiceController@getAllServices',
    
    '/unavailable_datetime/save' => 'UnavailableDatetimeController@save',
    '/unavailable_datetime/delete/{id}' => 'UnavailableDatetimeController@delete',
    '/unavailable_datetime/get_all' => 'UnavailableDatetimeController@getAllUnavailableDatetimes',
];