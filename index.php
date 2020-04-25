<?php

use App\Router\Router;

$starttime = microtime(true); // Top of page

session_start();

require __DIR__.'/vendor/autoload.php';

/**
 * Boot application routes
 */
if(Router::isCached())
    Router::checkRoute();
else{
    require './routes/web.php';
}

// Code
$endtime = microtime(true); // Bottom of page

printf("Page loaded in %f seconds", $endtime - $starttime );
