<?php

namespace Route;

class Route
{
    private static $requestUri;

    private static $uri;

    private static $method;

    private static $controller;

    private static $function;

    public function __construct()
    {

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

    private static function get()
    {
        $id = self::getId(self::$uri, self::$requestUri);
        $controller = self::$controller;
        $controller = "App\Controller\\$controller";
        $function = self::$function;
        $INSTANCE = new $controller();
        if ($id)
            echo $INSTANCE->$function($id);
        else
            echo $INSTANCE->$function();
    }

    private static function post()
    {
        $data = file_get_contents('php://input');
        $dataJson = json_decode($data);
        $id = self::getId(self::$uri, self::$requestUri);
        $controller = self::$controller;
        $controller = "App\Controller\\$controller";
        $function = self::$function;
        $INSTANCE = new $controller();
        if ($id)
            echo $INSTANCE->$function($dataJson, $id);
        else
            echo $INSTANCE->$function($dataJson);
    }

    public static function __callStatic($name, $arguments)
    {
        list($uri, $controllerMethod) = $arguments;
        $requestUri = $_SERVER["REQUEST_URI"];
        if (fnmatch($uri, $requestUri)) {
            list($controller, $method) = explode("@", $controllerMethod);
            $requestMethod = $_SERVER["REQUEST_METHOD"];
            self::$requestUri = $requestUri;
            self::$uri = $uri;
            self::$method = $requestMethod;
            self::$function = $method;
            self::$controller = $controller;
            if ($name == "get" && $requestMethod == "GET") {
                self::get();
            } else if ($name == "post" && $requestMethod == "POST") {
                self::post();
            }
        }
    }

    public function middleware($type)
    {
        switch($type){
            case "auth":
                if (isset($_SESSION["logged_in"]) ) {
                    if($_SESSION["logged_in"] != true)
                        die("Unauthorized");
                } else
                    die("Unauthorized");
                break;
        }
    }
}
