<?php
session_start();
require __DIR__.'/vendor/autoload.php';
require './routes/web.php';

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER["REQUEST_METHOD"];
if($requestMethod == 'POST'){
    $data = file_get_contents('php://input');
    switchRoute($requestUri,'POST',$data);
} else if($requestMethod == 'GET') {
    switchRoute($requestUri,'GET');
} else {
    die("Unsupported method");
}
