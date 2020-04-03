<?php

use App\Router\Router;

$router = new Router();

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
        $router->get('/subjects', 'Admin\SubjectController@index');
        $router->post('/subjects', 'Admin\SubjectController@store');
        $router->get('/subjects/create', 'Admin\SubjectController@create');
        $router->get('/subjects/{id}/edit', 'Admin\SubjectController@edit');
        $router->get('/subjects/{id}/delete', 'Admin\SubjectController@destroy');
        $router->post('/subjects/{id}', 'Admin\SubjectController@update');
        $router->get('/subjects/{id}', 'Admin\SubjectController@show');
        #endregion

        #region Students
        $router->get('/students', 'StudentController@index');
        $router->post('/students', 'StudentController@store');
        $router->get('/students/create', 'StudentController@create');
        $router->get('/students/{id}/edit', 'StudentController@edit');
        $router->get('/students/{id}/delete', 'StudentController@destroy');
        $router->post('/students/{id}', 'StudentController@update');
        $router->get('/students/{id}', 'StudentController@show');
        #endregion

        #region Teachers
        $router->get('/teachers', 'Admin\TeacherController@index');
        $router->post('/teachers', 'Admin\TeacherController@store');
        $router->get('/teachers/create', 'Admin\TeacherController@create');
        $router->get('/teachers/{id}/edit', 'Admin\TeacherController@edit');
        $router->get('/teachers/{id}/delete', 'Admin\TeacherController@destroy');
        $router->post('/teachers/{id}', 'Admin\TeacherController@update');
        $router->get('/teachers/{id}', 'Admin\TeacherController@show');
        #endregion

        #region Administrators
        $router->get('/admins', 'Admin\AdminController@index');
        $router->post('/admins', 'Admin\AdminController@store');
        $router->get('/admins/create', 'Admin\AdminController@create');
        $router->get('/admins/{id}/edit', 'Admin\AdminController@edit');
        $router->get('/admins/{id}/delete', 'Admin\AdminController@destroy');
        $router->post('/admins/{id}', 'Admin\AdminController@update');
        $router->get('/admins/{id}', 'Admin\AdminController@show');
        #endregion
    });

    $router->middleware(['teacher'])->prefix("/teacher")->group(function () use ($router) {
        #region Subjects
        $router->get('/subjects', 'SubjectController@index');
        $router->get('/subjects/{id}', 'SubjectController@show');
        #endregion

        #region Students
        $router->get('/students', 'StudentController@index');
        $router->get('/students/{id}', 'StudentController@show');
        #endregion
    });
});

$router->checkRoute();
