<?php

use Route\Route;

$router = new Route();

$router->get('/register', 'Auth\RegisterController@form');
$router->post('/register', 'Auth\RegisterController@register');
$router->get('/login', 'Auth\LoginController@form');
$router->post('/login', 'Auth\LoginController@login');

$router->middleware(['auth'])->group(function () use ($router) {
    $router->get('/logout', 'Auth\LoginController@logout');

    $router->get('/', function () {
        redirect('/schedule');
    });

    $router->get('/schedule', 'ScheduleController@index');

    #region Schedules
    $router->get('/schedules', 'ScheduleController@index');
    $router->post('/schedules', 'ScheduleController@store');
    $router->get('/schedules/create', 'ScheduleController@create');
    $router->get('/schedules/{id}/edit', 'ScheduleController@edit');
    $router->post('/schedules/{id}', 'ScheduleController@update');
    $router->get('/schedules/{id}', 'ScheduleController@show');
    #endregion

    $router->middleware(['admin'])->prefix("/admin")->group(function () use ($router) {
        #region Subjects
        $router->get('/subjects', 'SubjectController@index');
        $router->post('/subjects', 'SubjectController@store');
        $router->get('/subjects/create', 'SubjectController@create');
        $router->get('/subjects/{id}/edit', 'SubjectController@edit');
        $router->post('/subjects/{id}', 'SubjectController@update');
        $router->get('/subjects/{id}', 'SubjectController@show');
        #endregion
    });

    $router->middleware(['teacher'])->prefix("/teacher")->group(function () use ($router) {
        #region Subjects
        $router->get('/subjects', 'SubjectController@index');
        $router->post('/subjects', 'SubjectController@store');
        $router->get('/subjects/create', 'SubjectController@create');
        $router->get('/subjects/{id}/edit', 'SubjectController@edit');
        $router->post('/subjects/{id}', 'SubjectController@update');
        $router->get('/subjects/{id}', 'SubjectController@show');
        #endregion
    });

    #region Subjects
    $router->get('/subjects', 'SubjectController@index');
    $router->post('/subjects', 'SubjectController@store');
    $router->get('/subjects/create', 'SubjectController@create');
    $router->get('/subjects/{id}/edit', 'SubjectController@edit');
    $router->post('/subjects/{id}', 'SubjectController@update');
    $router->get('/subjects/{id}', 'SubjectController@show');
    #endregion

    #region Students
    $router->get('/students', 'StudentController@index');
    $router->post('/students', 'StudentController@store');
    $router->get('/students/create', 'StudentController@create');
    $router->get('/students/{id}/edit', 'StudentController@edit');
    $router->post('/students/{id}', 'StudentController@update');
    $router->get('/students/{id}', 'StudentController@show');
    #endregion

    #region Teachers
    $router->get('/teachers', 'TeacherController@index');
    $router->post('/teachers', 'TeacherController@store');
    $router->get('/teachers/create', 'TeacherController@create');
    $router->get('/teachers/{id}/edit', 'TeacherController@edit');
    $router->post('/teachers/{id}', 'TeacherController@update');
    $router->get('/teachers/{id}', 'TeacherController@show');
    #endregion

    #region Users
    $router->get('/users', 'UsersController@index');
    $router->post('/users', 'UsersController@store');
    $router->get('/users/create', 'UsersController@create');
    $router->get('/users/{id}/edit', 'UsersController@edit');
    $router->post('/users/{id}', 'UsersController@update');
    $router->get('/users/{id}', 'UsersController@show');
    #endregion
});

$router->get("/not-found",function(){
    return view('error/404', null, false);
});

$router->checkRoute();
