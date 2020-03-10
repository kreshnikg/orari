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
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        foreach ($this->routes as $route) {
            if (($route["uri"] == $requestUri) && ($route["requestMethod"] == $requestMethod)) {
                $controller = $route["controller"];
                $method = $route["method"];
                $controller = "App\Controller\\$controller";
                $INSTANCE = new $controller();
                if($route["requestMethod"] == "POST"){
                    return $INSTANCE->$method($_POST);
                } else {
                    return $INSTANCE->$method();
                }
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
        $this->registerRoute($uri,$callback,"GET");
    }

    /**
     * Define a POST route
     *
     * @param string $uri
     * @param string $callback
     */
    public function post($uri,$callback)
    {
        $this->registerRoute($uri,$callback,"POST");
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
