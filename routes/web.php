<?php

use App\Router\Router;

$defaultView = "ViewController@defaultView";

Router::get('/login', 'Auth\LoginController@form');
Router::get('/register', 'Auth\RegisterController@form');

Router::middleware(['auth'])->group(function () use ($defaultView) {
    Router::get('/logout', 'Auth\LoginController@logout');

    Router::get("/",$defaultView);

    Router::middleware(['admin'])->prefix("/admin")->group(function () use ($defaultView) {

        Router::get('/schedules', $defaultView);
        Router::get('/schedules/create', $defaultView);

        #region Subjects
        Router::get('/subjects', $defaultView);
        Router::get('/subjects/create', $defaultView);
        Router::get('/subjects/{id}/edit', $defaultView);
        Router::get('/subjects/{id}', $defaultView);
        #endregion

        #region Students
        Router::get('/students', $defaultView);
        Router::get('/students/create', $defaultView);
        Router::get('/students/{id}/edit', $defaultView);
        Router::get('/students/{id}', $defaultView);
        #endregion

        #region Teachers
        Router::get('/teachers', $defaultView);
        Router::get('/teachers/create', $defaultView);
        Router::get('/teachers/{id}/edit', $defaultView);
        Router::get('/teachers/{id}', $defaultView);
        #endregion

        #region Administrators
        Router::get('/admins', $defaultView);
        Router::get('/admins/create', $defaultView);
        Router::get('/admins/{id}/edit', $defaultView);
        Router::get('/admins/{id}', $defaultView);
        #endregion

        #region Classrooms
        Router::get('/groups', $defaultView);
        Router::get('/groups/create', $defaultView);
        Router::get('/groups/{id}/edit', $defaultView);
        Router::get('/groups/{id}', $defaultView);
        #endregion

        #region Classrooms
        Router::get('/classrooms', $defaultView);
        Router::get('/classrooms/create', $defaultView);
        Router::get('/classrooms/{id}/edit', $defaultView);
        Router::get('/classrooms/{id}', $defaultView);
        #endregion
    });

    Router::middleware(['teacher'])->prefix("/teacher")->group(function () use ($defaultView) {
        #region Subjects
        Router::get('/subjects', $defaultView);
        Router::get('/subjects/{id}', $defaultView);
        #endregion

        Router::get('/schedule', $defaultView);
        #region Students
        Router::get('/students', $defaultView);
        Router::get('/students/{id}', $defaultView);
        #endregion
    });

    Router::middleware(['student'])->prefix("/student")->group(function () use ($defaultView) {
        #region Subjects
        Router::get('/subjects', $defaultView);
        Router::get('/schedule', $defaultView);
        #endregion
    });
});

