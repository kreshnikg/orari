<?php
session_start();
require __DIR__.'/../vendor/autoload.php';

use App\Router\Router;
/**
 * Boot application routes
 */
//if(Router::isCached())
//    Router::checkRoute();
//else

if (isXhr())
    require __DIR__.'/../routes/api.php';
else
    require __DIR__.'/../routes/web.php';

Router::checkRoute();

