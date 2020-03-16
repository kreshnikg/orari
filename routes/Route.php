<?php

namespace Route;

class Route
{

    /**
     * Application routes.
     * @var array
     */
    public $routes = [];

    private function getUriWithRegex($uri){

        $hasParameters = false;
        $uriArray = array_filter(explode("/", $uri));
        foreach ($uriArray as $key => $value) {
            if($value[0] == "{"){
                $uriArray[$key] = "(.*?)";
                $hasParameters = true;
            }
        }
        if($hasParameters){
            $uriWithRegex = "#/" . implode("/",$uriArray) . "$#";
            return $uriWithRegex;
        }
        return $uri;
    }

    private function matchRoute($route,$requestUri,$requestMethod){
        $routeUri = $route["uri"];
        $routeUriRegex = $this->getUriWithRegex($routeUri);
        if($routeUriRegex != $routeUri){
            $routeCheck = preg_match($routeUriRegex, $requestUri);
        } else {
            $routeCheck = $routeUri == $requestUri;
        }
        return ($routeCheck && ($route["requestMethod"] == $requestMethod));
    }

    private function excecuteRouteCallback($route,$requestUri){
        $callback = $route["callback"];
        if($callback != null){
            return $callback();
        }

        $controller = $route["controller"];
        $method = $route["method"];
        $controller = "App\Controller\\$controller";
        $INSTANCE = new $controller();

        $uriParameters = $this->getParameters($route["uri"], $requestUri);

        $methodParameters = array();
        if($route["requestMethod"] == "POST"){
            array_push($methodParameters, $_POST);
        }
        if(count($uriParameters) > 0){
            array_push($methodParameters, ...$uriParameters);
        }
        return $INSTANCE->$method(...$methodParameters);
    }

    /**
     * Map current route to callback.
     *
     * @return mixed
     */
    public function checkRoute()
    {
        $requestUri = $_SERVER["REQUEST_URI"];
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        foreach ($this->routes as $route) {
            if ($this->matchRoute($route,$requestUri,$requestMethod)) {
                if($route["authenticated"]){
                    if(!isAuthenticated())
                        redirect('/login');
                }
                return $this->excecuteRouteCallback($route,$requestUri);
            }
        }
        return view('error/404');
    }

    /**
     * Add route.
     *
     * @param object $route
     */
    private function addRoute($route)
    {
        array_push($this->routes,$route);
    }

    /**
     * Register route to $this->routes.
     *
     * @param string $uri
     * @param string $callback
     * @param string $requestMethod
     * @param boolean $authenticated
     * @return void
     */
    private function registerRoute($uri, $callback, $requestMethod, $authenticated)
    {
        if(is_callable($callback)) {
            $route = [
                'uri' => $uri,
                'controller' => null,
                'method' => null,
                'requestMethod' => $requestMethod,
                'authenticated' => $authenticated,
                'callback' => $callback
            ];
        } else {
            list($controller, $method) = explode("@", $callback);
            $route = [
                'uri' => $uri,
                'controller' => $controller,
                'method' => $method,
                'requestMethod' => $requestMethod,
                'authenticated' => $authenticated,
                'callback' => null
            ];
        }
        $this->addRoute($route);
    }

    private function getParameters($uri, $requestUri)
    {
        $uriArray = array_filter(explode("/", $uri));
        $requestUriArray = array_filter(explode("/", $requestUri));

        $ids = array();
        foreach ($uriArray as $key => $value) {
            if($value[0] == "{"){
                array_push($ids, $key);
            }
        }

        $parameters = array();
        if(count($ids) > 0) {
            foreach($ids as $id){
                array_push($parameters, $requestUriArray[$id]);
            }
        }

        return $parameters;
    }

    /**
     * Define a GET route.
     *
     * @param string $uri
     * @param string $callback
     * @param boolean $authenticated
     */
    public function get($uri,$callback, $authenticated = true)
    {
        $this->registerRoute($uri,$callback,"GET", $authenticated);
    }

    /**
     * Define a POST route.
     *
     * @param string $uri
     * @param string $callback
     * @param boolean $authenticated
     */
    public function post($uri,$callback, $authenticated = true)
    {
        $this->registerRoute($uri,$callback,"POST", $authenticated);
    }
}
