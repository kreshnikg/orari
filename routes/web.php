<?php

use Route\Route;

$router = new Route();

$router->get('/users', 'PerdoruesiController@index');

$router->get('/login', 'Auth\LoginController@loginForm');

$router->checkRoute();
