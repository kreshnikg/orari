<?php

use App\Router\Router;


Router::post('/api/login', "Auth\LoginController@login");
Router::post('/api/register', "Auth\RegisterController@register");

Router::middleware(['auth'])->prefix("/api")->group(function () {
    Router::get('/logout', 'Auth\LoginController@logout');

    Router::middleware(['admin'])->prefix("/admin")->group(function () {
        #region Subjects
        Router::get('/subjects', 'Admin\SubjectController@index');
        Router::post('/subjects', 'Admin\SubjectController@store');
        Router::get('/subjects/{id}/edit', 'Admin\SubjectController@edit');
        Router::post('/subjects/{id}/delete', 'Admin\SubjectController@destroy');
        Router::post('/subjects/{id}', 'Admin\SubjectController@update');
        Router::get('/subjects/{id}', 'Admin\SubjectController@show');
        #endregion
    });
});
