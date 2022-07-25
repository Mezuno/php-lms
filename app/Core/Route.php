<?php

namespace App\Core;

use App\Users\Controllers\UserController as UserController;

class Route
{

    private $uri;
    private $correctRoutes = [];
    private $routeParams = [];


    function __construct($uri)
    {
        $uri = parse_url(trim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH);

        $this->uri = $uri;
    }

    public function startRoute($allRoutes)
    {
        preg_match('/users\/(\d+)/', $_SERVER['REQUEST_URI'], $matches);

        //creating regex for matching uri and route from routes.php with preg_match
        foreach ($allRoutes as $route => $params) {
            $route = '~^' . $route . '$~';
            $this->correctRoutes[$route] = $params;
        }
    
        if (!$this->matchRoute($this->correctRoutes, $this->uri)) {
            require $_SERVER['DOCUMENT_ROOT'].'/resources/views/404.php';
            die;
        } else {
            $controllerPath = $_SERVER['DOCUMENT_ROOT'].'/app/' . $this->routeParams['controller'] . 's/Controllers/'.$this->routeParams['controller'] . 'Controller.php';
            require $controllerPath;

            $controllerName = 'App\\' . $this->routeParams['controller'] . 's\Controllers\\'.$this->routeParams['controller'].'Controller';
            $controller = new $controllerName();

            $actionName = $this->routeParams['action'];

            if (isset($matches[1])) {
                $controller->$actionName($matches[1]);
            } else {
                $controller->$actionName();
            }
            
            die;
        }
    }

    private function matchRoute(array $routes, string $uri)
    {
        foreach ($routes as $route => $params) {
            if (preg_match($route, $uri)) {
                $this->routeParams = $params;
                return true;
            }
        }
        return false;
    }

}
