<?php

function startRoute(array $routes)
{
    $uri = parse_url(trim($_SERVER['REQUEST_URI'], '/'), PHP_URL_PATH);
    $requestMethod = $_SERVER['REQUEST_METHOD'];
    $correctRoutes = [];
    $routeParams = [];

    //creating regex for matching uri and route from routes.php with preg_match
    foreach ($routes as $route => $params) {
        $route = '~^' . $route . '$~';
        $correctRoutes[$route] = $params;
    }

    if (!matchRoute($correctRoutes, $routeParams, $uri)) {
        require $_SERVER['DOCUMENT_ROOT'].'/pages/404.php';
        die;
    } else {
        $path = $_SERVER['DOCUMENT_ROOT'] . '/' . $routeParams['filename'] . '.php';

        if (!file_exists($path)) {
            require $_SERVER['DOCUMENT_ROOT'].'/pages/404.php';
            die;
        } else {
            require $path;
        }
    }
}

function matchRoute(array $routes, array &$routeParams, string $uri)
{
    foreach ($routes as $route => $params) {
        if (preg_match($route, $uri)) {
            $routeParams = $params;
            return true;
        }
    }
    return false;
}