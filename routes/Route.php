<?php

namespace Route;

class Route
{

    /**
     * Application routes
     * @var array
     */
    public $routes = [];

    /**
     * Map current route to controller callback
     * @return mixed
     */
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
        return view('error/404');
    }

    /**
     * Add route
     *
     * @param object $route
     */
    private function addRoute($route)
    {
        array_push($this->routes,$route);
    }

    /**
     * Register route to $this->routes
     *
     * @param string $uri
     * @param string $callback
     * @param string $requestMethod
     * @return void
     */
    private function registerRoute($uri, $callback,$requestMethod)
    {
        list($controller, $method) = explode("@", $callback);
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

    /**
     * Define a GET route
     *
     * @param string $uri
     * @param string $callback
     */
    public function get($uri,$callback)
    {
        if($_SERVER["REQUEST_METHOD"] != "GET")
            response('Wrong method', 500);
        $this->registerRoute($uri,$callback,"GET");
    }

    /**
     * Define a POST route
     *
     * @param string $uri
     * @param string $callback
     */
    private function post($uri,$callback)
    {
        if($_SERVER["REQUEST_METHOD"] != "POST")
            response('Wrong method', 500);
        $this->registerRoute($uri,$callback,"POST");

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
