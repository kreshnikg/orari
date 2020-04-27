<?php

namespace App\Router;

class Router
{

    /**
     * Application routes.
     * @var array
     */
    public static $routes = [];

    /**
     * Routes prefix.
     * @var array
     */
    private static $prefix = [];

    /**
     * Routes middleware.
     * @var array
     */
    private static $middleware = [];

    /**
     * Convert route uri to regex.
     *
     * @param string $uri
     * @return string
     */
    private static function getUriWithRegex($uri)
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
    private static function matchRoute($route, $requestUri, $requestMethod)
    {
        $routeUri = $route["uri"];
        $routeUriRegex = self::getUriWithRegex($routeUri);
        if ($routeUriRegex != $routeUri) {
            $routeCheck = preg_match($routeUriRegex, $requestUri);
        } else {
            $routeCheck = $routeUri == $requestUri;
        }
        return ($routeCheck && ($route["requestMethod"] == $requestMethod));
    }

    private static function excecuteRouteCallback($route, $uriParameters)
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
    public static function checkRoute()
    {
        $parsedUrl = parse_url($_SERVER["REQUEST_URI"]);
        $path = $parsedUrl["path"];
        $requestMethod = $_SERVER["REQUEST_METHOD"];

//        $routes = self::loadRoutesFromCache();
        $routes = self::$routes;
        foreach ($routes as $route) {
            if (self::matchRoute($route, $path, $requestMethod)) {

                self::checkMiddleware($route);

                $uriParameters = self::getParameters($route["uri"], $path);

                return self::excecuteRouteCallback($route, $uriParameters);
            }
        }
        return view("error/404", null, false);
    }

    /**
     * Add route.
     *
     * @param object|array $route
     */
    private static function addRoute($route)
    {
        array_push(self::$routes, $route);
    }

    private static function concatPrefixes(){

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
    private static function registerRoute($uri, $callback, $requestMethod, $middleware)
    {
        $uriPrefix = $uri;
        if (count(self::$prefix) > 0)
            $uriPrefix = implode("",self::$prefix) . $uri;
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
        self::addRoute($route);
    }

    /**
     * @param string $uri
     * @param string $requestUri
     * @return array
     */
    private static function getParameters($uri, $requestUri)
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
        array_push(self::$prefix, $prefix);
        return $this;
    }

    /**
     * @param callable $callback
     * @return $this
     */
    public function group($callback)
    {
        $callback();
        array_pop(self::$prefix);
        array_pop(self::$middleware);
    }

    /**
     * @param $middlewares
     * @return $this
     */
    public static function middleware($middlewares)
    {
        $check = false;
        foreach ($middlewares as $middleware) {
            foreach (self::$middleware as $middlew) {
                if (in_array($middleware, $middlew))
                    $check = true;
            }
        }
        if (!$check)
            array_push(self::$middleware, $middlewares);
        return new static;
    }

    private static function checkMiddleware($route)
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
    public static function get($uri, $callback)
    {
        self::registerRoute($uri, $callback, "GET", self::$middleware);
    }

    /**
     * Define a POST route.
     *
     * @param string $uri
     * @param string $callback
     */
    public static function post($uri, $callback)
    {
        self::registerRoute($uri, $callback, "POST", self::$middleware);
    }

    private static function getRouteCacheDirectory()
    {
        return $_SERVER['DOCUMENT_ROOT'] . "/storage/cache/routes.txt";
    }

    private static function getCacheFile()
    {
        return @file_get_contents(self::getRouteCacheDirectory());
    }

    public static function isCached()
    {
        $cacheFile = self::getCacheFile();
        return $cacheFile ? true : false;
    }

    private static function writeRoutesOnCacheFile()
    {
        $routeCache = fopen(self::getRouteCacheDirectory(), "w");
        fwrite($routeCache, json_encode(self::$routes));
    }

    private static function loadRoutesFromCache()
    {
        if(self::isCached())
            return json_decode(self::getCacheFile(),true);
        else {
            self::writeRoutesOnCacheFile();
            return self::$routes;
        }
    }
}
