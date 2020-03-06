<?php
session_start();

$requestUri = $_SERVER['REQUEST_URI'];
if ($requestUri == '/index.php' || $requestUri == '/') {
    require('./views/login.php');
}
