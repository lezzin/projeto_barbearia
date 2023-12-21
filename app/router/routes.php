<?php

$routes = [
    '/' => 'HomeController@index',
    
    '/login' => 'HomeController@login',
    '/verify' => 'HomeController@verify',
    '/logout' => 'HomeController@logout',
    
    '/schedule' => 'ScheduleController@index',

    '/admin' => 'AdminController@index',

    '/service/create' => 'ServiceController@create',
    '/service/edit/{id}' => 'ServiceController@edit',
    '/service/delete/{id}' => 'ServiceController@delete',
    '/service/update' => 'ServiceController@update'
];