<?php

use App\Router\Router;

$defaultView = "ViewController@defaultView";

Router::get('/login', 'Auth\LoginController@form');
Router::get('/register', 'Auth\RegisterController@form');

Router::middleware(['auth'])->group(function () use ($defaultView) {
    Router::get('/logout', 'Auth\LoginController@logout');

    Router::get('/', function () {
        redirect('/schedule');
    });

    Router::get('/schedule', 'ScheduleController@index');

    #region Schedules
    Router::get('/schedules', 'ScheduleController@index');
    Router::post('/schedules', 'ScheduleController@store');
    Router::get('/schedules/create', 'ScheduleController@create');
    Router::get('/schedules/{id}/edit', 'ScheduleController@edit');
    Router::post('/schedules/{id}', 'ScheduleController@update');
    Router::get('/schedules/{id}', 'ScheduleController@show');
    #endregion

    Router::middleware(['admin'])->prefix("/admin")->group(function () use ($defaultView) {

        #region Schedules
        Router::get('/schedules', 'Admin\ScheduleController@index');
        #endregion

        #region Subjects
        Router::get('/subjects', $defaultView);
//        Router::post('/subjects', 'Admin\SubjectController@store');
//        Router::get('/subjects/create', 'Admin\SubjectController@create');
//        Router::get('/subjects/{id}/edit', 'Admin\SubjectController@edit');
//        Router::get('/subjects/{id}/delete', 'Admin\SubjectController@destroy');
//        Router::post('/subjects/{id}', 'Admin\SubjectController@update');
//        Router::get('/subjects/{id}', 'Admin\SubjectController@show');
        #endregion

        #region Students
        Router::get('/students', $defaultView);
        Router::post('/students', 'StudentController@store');
        Router::get('/students/create', 'StudentController@create');
        Router::get('/students/{id}/edit', 'StudentController@edit');
        Router::get('/students/{id}/delete', 'StudentController@destroy');
        Router::post('/students/{id}', 'StudentController@update');
        Router::get('/students/{id}', 'StudentController@show');
        #endregion

        #region Teachers
        Router::get('/teachers', 'Admin\TeacherController@index');
        Router::post('/teachers', 'Admin\TeacherController@store');
        Router::get('/teachers/create', 'Admin\TeacherController@create');
        Router::get('/teachers/{id}/edit', 'Admin\TeacherController@edit');
        Router::get('/teachers/{id}/delete', 'Admin\TeacherController@destroy');
        Router::post('/teachers/{id}', 'Admin\TeacherController@update');
        Router::get('/teachers/{id}', 'Admin\TeacherController@show');
        #endregion

        #region Administrators
        Router::get('/admins', 'Admin\AdminController@index');
        Router::post('/admins', 'Admin\AdminController@store');
        Router::get('/admins/create', 'Admin\AdminController@create');
        Router::get('/admins/{id}/edit', 'Admin\AdminController@edit');
        Router::get('/admins/{id}/delete', 'Admin\AdminController@destroy');
        Router::post('/admins/{id}', 'Admin\AdminController@update');
        Router::get('/admins/{id}', 'Admin\AdminController@show');
        #endregion

        #region Classrooms
        Router::get('/classrooms', 'Admin\ClassroomController@index');
        Router::post('/classrooms', 'Admin\ClassroomController@store');
        Router::get('/classrooms/create', 'Admin\ClassroomController@create');
        Router::get('/classrooms/{id}/edit', 'Admin\ClassroomController@edit');
        Router::get('/classrooms/{id}/delete', 'Admin\ClassroomController@destroy');
        Router::post('/classrooms/{id}', 'Admin\ClassroomController@update');
        Router::get('/classrooms/{id}', 'Admin\ClassroomController@show');
        #endregion
    });

    Router::middleware(['teacher'])->prefix("/teacher")->group(function () {
        #region Subjects
        Router::get('/subjects', 'SubjectController@index');
        Router::get('/subjects/{id}', 'SubjectController@show');
        #endregion

        #region Students
        Router::get('/students', 'StudentController@index');
        Router::get('/students/{id}', 'StudentController@show');
        #endregion
    });

    Router::middleware(['student'])->prefix("/student")->group(function () {
        #region Subjects
        Router::get('/subjects', 'Student\SubjectController@index');
        Router::get('/subjects/submit', 'Student\SubjectController@submit');
        Router::get('/subjects/{id}/register', 'Student\SubjectController@register');
        Router::get('/subjects/{id}/cancel', 'Student\SubjectController@cancel');
        #endregion
    });
});

