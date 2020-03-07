<?php

use Route\Route;

function switchRoute($request,$method,$data = null){

    if(!isset($request) || !isset($method))
        die("Error");

    if($method == 'POST') {
        if($data == null)
            die("Error");

        switch ($request) {
            case '/api/users' :
                echo PerdoruesiController::store($data);
                break;
            case '/api/login' :
                echo LoginController::login($data);
                break;
            case '/api/register' :
                echo RegisterController::register($data);
                break;
            default:
                die('Not found!');
                break;
        }
    } else {
        $requestArray = explode('/',$request);
        $id = isset($requestArray[3]) ? $requestArray[3] : null;
        switch ($request) {
            case '/users' :
                Route::get($request,'PerdoruesiController@index');
                break;
            case (fnmatch('/api/users/*',$request) ? true : false) :
                echo PerdoruesiController::show($id);
                break;
            case '/api/logout' :
                echo LoginController::logout();
                break;
            default:
                die('Not found!');
                break;
        }
    }
}
