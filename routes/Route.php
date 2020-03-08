<?php

namespace Route;

class Route
{

    public $routes = [];

    public function __construct()
    {

    }

    public function checkRoute()
    {
        $requestUri = $_SERVER["REQUEST_URI"];
        foreach ($this->routes as $route) {
            if ($route["uri"] == $requestUri) {
                $controller = $route["controller"];
                $method = $route["method"];
                $controller = "App\Controller\\$controller";
                $INSTANCE = new $controller();
                return $INSTANCE->$method();
            }
        }
        response('Route not found!',404);
    }

    private function addRoute($route)
    {
        array_push($this->routes,$route);
    }

    private function registerRoute($uri, $controllerMethod,$requestMethod)
    {
        list($controller, $method) = explode("@", $controllerMethod);
        $route = [
            'uri' => $uri,
            'controller' => $controller,
            'method' => $method,
            'requestMethod' => $requestMethod
        ];
        $this->addRoute($route);
    }

    private static function getId($uri, $requestUri)
    {
        $requestUriArray = explode("/", $requestUri);
        $uriArray = explode("/", $uri);
        foreach ($uriArray as $key => $value) {
            if ($value == "*") {
                return $requestUriArray[$key];
            }
        }
        return false;
    }

    public function get($uri,$controllerMethod)
    {
        if($_SERVER["REQUEST_METHOD"] != "GET")
            response('Wrong method', 500);
        $this->registerRoute($uri,$controllerMethod,"GET");
    }

    private function post($uri,$controllerMethod)
    {
        if($_SERVER["REQUEST_METHOD"] != "POST")
            response('Wrong method', 500);
        $this->registerRoute($uri,$controllerMethod,"POST");

//        $data = file_get_contents('php://input');
//        $dataJson = json_decode($data);
//        $id = self::getId(self::$uri, self::$requestUri);
//        $controller = self::$controller;
//        $controller = "App\Controller\\$controller";
//        $function = self::$function;
//        $INSTANCE = new $controller();
//        if ($id)
//            echo $INSTANCE->$function($dataJson, $id);
//        else
//            echo $INSTANCE->$function($dataJson);
    }

    public function middleware($type)
    {
        switch ($type) {
            case "auth":
                if (isset($_SESSION["logged_in"])) {
                    if ($_SESSION["logged_in"] != true)
                        die("Unauthorized");
                } else
                    die("Unauthorized");
                break;
        }
    }
}
