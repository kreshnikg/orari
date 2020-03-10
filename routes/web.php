<?php

use Route\Route;

$router = new Route();

$router->get('/users', 'PerdoruesiController@index');
$router->post('/users', 'PerdoruesiController@store');
$router->get('/users/create', 'PerdoruesiController@create');

$router->get('/login', 'Auth\LoginController@form');
$router->post('/login', 'Auth\LoginController@login');
$router->post('/logout', 'Auth\LoginController@logout');

$router->get('/register', 'Auth\RegisterController@form');
$router->post('/register', 'Auth\RegisterController@register');

$router->checkRoute();
