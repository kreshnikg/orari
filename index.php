<?php
session_start();
require __DIR__.'/vendor/autoload.php';

$requestUri = $_SERVER['REQUEST_URI'];
if ($requestUri == '/index.php' || $requestUri == '/') {
    require('./views/login.php');
}
