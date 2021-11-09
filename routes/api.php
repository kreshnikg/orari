<?php

use App\Router\Router;


Router::post('/api/login', "Auth\LoginController@login");
Router::post('/api/register', "Auth\RegisterController@register");

Router::middleware(['auth'])->prefix("/api")->group(function () {
    Router::get('/logout', 'Auth\LoginController@logout');

    Router::middleware(['admin'])->prefix("/admin")->group(function () {
        #region Subjects
        Router::get('/schedules', 'Admin\ScheduleController@index');
        Router::post('/schedules', 'Admin\ScheduleController@store');
        Router::get('/schedules/create', 'Admin\ScheduleController@create');
        Router::post('/schedules/{schedule}/delete', 'Admin\ScheduleController@destroy');

        #endregion

        #region Subjects
        Router::get('/subjects', 'Admin\SubjectController@index');
        Router::post('/subjects', 'Admin\SubjectController@store');
        Router::get('/subjects/create', 'Admin\SubjectController@create');
        Router::get('/subjects/teachers', 'Admin\SubjectController@registerTeachers');
        Router::post('/subjects/teachers', 'Admin\SubjectController@addSubjectTeacher');
        Router::get('/subjects/{id}/edit', 'Admin\SubjectController@edit');
        Router::post('/subjects/{id}/delete', 'Admin\SubjectController@destroy');
        Router::post('/subjects/{id}', 'Admin\SubjectController@update');
        Router::get('/subjects/{id}', 'Admin\SubjectController@show');
        #endregion

        #region Students
        Router::get('/students', 'StudentController@index');
        Router::post('/students', 'StudentController@store');
        Router::get('/students/create', 'StudentController@create');
        Router::get('/students/{id}/edit', 'StudentController@edit');
        Router::post('/students/{id}/delete', 'StudentController@destroy');
        Router::post('/students/{id}', 'StudentController@update');
        Router::get('/students/{id}', 'StudentController@show');
        #endregion

        #region Teachers
        Router::get('/teachers', 'Admin\TeacherController@index');
        Router::post('/teachers', 'Admin\TeacherController@store');
        Router::get('/teachers/create', 'Admin\TeacherController@create');
        Router::get('/teachers/{id}/edit', 'Admin\TeacherController@edit');
        Router::post('/teachers/{id}/delete', 'Admin\TeacherController@destroy');
        Router::post('/teachers/{id}', 'Admin\TeacherController@update');
        Router::get('/teachers/{id}', 'Admin\TeacherController@show');
        #endregion

        #region Teachers
        Router::get('/admins', 'Admin\AdminController@index');
        Router::post('/admins', 'Admin\AdminController@store');
        Router::get('/admins/{id}/edit', 'Admin\AdminController@edit');
        Router::post('/admins/{id}/delete', 'Admin\AdminController@destroy');
        Router::post('/admins/{id}', 'Admin\AdminController@update');
        Router::get('/admins/{id}', 'Admin\AdminController@show');
        #endregion

        #region Groups
        Router::get('/groups', 'Admin\GroupController@index');
        Router::post('/groups', 'Admin\GroupController@store');
        Router::get('/groups/create', 'Admin\GroupController@create');
        Router::get('/groups/create/get-students-count/{semesterId}', 'Admin\GroupController@getStudentsCount');
        Router::get('/groups/{id}/edit', 'Admin\GroupController@edit');
        Router::post('/groups/{id}/delete', 'Admin\GroupController@destroy');
        Router::post('/groups/{id}', 'Admin\GroupController@update');
        Router::get('/groups/{id}', 'Admin\GroupController@show');
        #endregion

        #region Classrooms
        Router::get('/classrooms', 'Admin\ClassroomController@index');
        Router::post('/classrooms', 'Admin\ClassroomController@store');
        Router::get('/classrooms/create', 'Admin\ClassroomController@create');
        Router::get('/classrooms/{id}/edit', 'Admin\ClassroomController@edit');
        Router::post('/classrooms/{id}/delete', 'Admin\ClassroomController@destroy');
        Router::post('/classrooms/{id}', 'Admin\ClassroomController@update');
        Router::get('/classrooms/{id}', 'Admin\ClassroomController@show');
        #endregion
    });

    Router::middleware(['student'])->prefix("/student")->group(function () {
        Router::get('/subjects', 'Student\SubjectController@index');
        Router::get('/schedule', 'Admin\ScheduleController@index');
        Router::post('/subjects/submit', 'Student\SubjectController@submit');
        Router::post('/subjects/{id}/register', 'Student\SubjectController@register');
        Router::post('/subjects/{id}/cancel', 'Student\SubjectController@cancel');
    });

    Router::middleware(['teacher'])->prefix("/teacher")->group(function () {
        Router::get('/schedule', 'Teacher\ScheduleController@index');
    });
});
