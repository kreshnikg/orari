<?php

use Route\Route;

$router = new Route();

#region Authentication
$router->get('/register', 'Auth\RegisterController@form',false);
$router->post('/register', 'Auth\RegisterController@register',false);
$router->get('/login', 'Auth\LoginController@form',false);
$router->post('/login', 'Auth\LoginController@login',false);
$router->get('/logout', 'Auth\LoginController@logout');
#endregion

$router->get('/', function(){
    redirect('/orari');
});

$router->get('/orari', 'OrariController@index');

$router->get('/lendet', 'LendaController@index');

$router->get('/users', 'PerdoruesiController@index');
$router->post('/users', 'PerdoruesiController@store');
$router->get('/users/create', 'PerdoruesiController@create');
$router->get('/users/{id}/edit', 'PerdoruesiController@edit');
$router->post('/users/{id}', 'PerdoruesiController@update');
$router->get('/users/{id}', 'PerdoruesiController@show');

$router->checkRoute();
