<?php

namespace Route;

class Route
{

    /**
     * Application routes.
     * @var array
     */
    public $routes = [];

    /**
     * Routes prefix.
     * @var string
     */
    private $prefix = null;

    /**
     * Routes middleware.
     * @var array
     */
    private $middleware = [];

    /**
     * Convert route uri to regex.
     *
     * @param string $uri
     * @return string
     */
    private function getUriWithRegex($uri)
    {
        $hasParameters = false;
        $uriArray = array_filter(explode("/", $uri));
        foreach ($uriArray as $key => $value) {
            if ($value[0] == "{") {
                $uriArray[$key] = "(.*?)";
                $hasParameters = true;
            }
        }
        if ($hasParameters) {
            $uriWithRegex = "#/" . implode("/", $uriArray) . "$#";
            return $uriWithRegex;
        }
        return $uri;
    }

    /**
     * Match requested route.
     *
     * @param object $route
     * @param string $requestUri
     * @param string $requestMethod
     * @return bool
     */
    private function matchRoute($route, $requestUri, $requestMethod)
    {
        $routeUri = $route["uri"];
        $routeUriRegex = $this->getUriWithRegex($routeUri);
        if ($routeUriRegex != $routeUri) {
            $routeCheck = preg_match($routeUriRegex, $requestUri);
        } else {
            $routeCheck = $routeUri == $requestUri;
        }
        return ($routeCheck && ($route["requestMethod"] == $requestMethod));
    }

    private function excecuteRouteCallback($route, $uriParameters)
    {
        $callback = $route["callback"];
        if ($callback != null) {
            return $callback(...$uriParameters);
        }

        $controller = $route["controller"];
        $method = $route["method"];
        $controller = "App\Controller\\$controller";
        $INSTANCE = new $controller();

        $methodParameters = array();
        if ($route["requestMethod"] == "POST") {
            array_push($methodParameters, $_POST);
        }
        if (count($uriParameters) > 0) {
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
        $parsedUrl = parse_url($_SERVER["REQUEST_URI"]);
        $path = $parsedUrl["path"];
        $requestMethod = $_SERVER["REQUEST_METHOD"];
        foreach ($this->routes as $route) {
            if ($this->matchRoute($route, $path, $requestMethod)) {

                $this->checkMiddleware($route);

                $uriParameters = $this->getParameters($route["uri"], $path);

                return $this->excecuteRouteCallback($route, $uriParameters);
            }
        }
        redirect('/not-found');
    }

    /**
     * Add route.
     *
     * @param object|array $route
     */
    private function addRoute($route)
    {
        array_push($this->routes, $route);
    }

    /**
     * Register route to $this->routes.
     *
     * @param string $uri
     * @param string $callback
     * @param string $requestMethod
     * @param array $middleware
     * @return void
     */
    private function registerRoute($uri, $callback, $requestMethod, $middleware)
    {
        $uriPrefix = $uri;
        if ($this->prefix)
            $uriPrefix = $this->prefix . $uri;
        $route = [
            'uri' => $uriPrefix,
            'requestMethod' => $requestMethod,
            'middleware' => $middleware,
            'callback' => null
        ];
        if (is_callable($callback))
            $route["callback"] = $callback;
        else {
            list($controller, $method) = explode("@", $callback);
            $route['controller'] = $controller;
            $route['method'] = $method;
        }
        $this->addRoute($route);
    }

    /**
     * @param string $uri
     * @param string $requestUri
     * @return array
     */
    private function getParameters($uri, $requestUri)
    {
        $uriArray = array_filter(explode("/", $uri));
        $requestUriArray = array_filter(explode("/", $requestUri));

        $ids = array();
        foreach ($uriArray as $key => $value) {
            if ($value[0] == "{") {
                array_push($ids, $key);
            }
        }

        $parameters = array();
        if (count($ids) > 0) {
            foreach ($ids as $id) {
                array_push($parameters, $requestUriArray[$id]);
            }
        }

        return $parameters;
    }

    /**
     * @param string $prefix
     * @return $this
     */
    public function prefix($prefix)
    {
        $this->prefix = $prefix;
        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function group($callback)
    {
        $callback();
        $this->prefix = null;
        array_pop($this->middleware);
    }

    /**
     * @param $middlewares
     * @return $this
     */
    public function middleware($middlewares)
    {
        $check = false;
        foreach($middlewares as $middleware){
            foreach($this->middleware as $middlew){
                if(in_array($middleware,$middlew))
                    $check = true;
            }
        }
        if(!$check)
            array_push($this->middleware, $middlewares);
        return $this;
    }

    private function checkMiddleware($route)
    {
        $middlewares = $route["middleware"];
        foreach ($middlewares as $middlewareGroup) {
            foreach ($middlewareGroup as $middleware) {
                //Authentication
                if ($middleware == "auth") {
                    if (!isAuthenticated())
                        redirect('/login');
                }
                //Roles
                if ($middleware == "admin") {
                    if (user()->role != "admin")
                        redirect('/');
                } else if ($middleware == "teacher") {
                    if (user()->role != "teacher")
                        redirect('/');
                } else if ($middleware == "student") {
                    if (user()->role != "student")
                        redirect('/');
                }
            }
        }
    }

    /**
     * Define a GET route.
     *
     * @param string $uri
     * @param string $callback
     */
    public function get($uri, $callback)
    {
        $this->registerRoute($uri, $callback, "GET", $this->middleware);
    }

    /**
     * Define a POST route.
     *
     * @param string $uri
     * @param string $callback
     */
    public function post($uri, $callback)
    {
        $this->registerRoute($uri, $callback, "POST", $this->middleware);
    }
}
