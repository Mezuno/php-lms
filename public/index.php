<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

spl_autoload_register(function ($className) {
    $className = str_replace('\\', '/', $className);
    require_once('../' . $className . '.php');
});

$allRoutes = require $_SERVER['DOCUMENT_ROOT'].'/routes/routes.php';

use app\Core\Route as Route;

$route = new Route($_SERVER['REQUEST_URI']);

$route->startRoute($allRoutes);

