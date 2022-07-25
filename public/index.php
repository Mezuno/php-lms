<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);


require $_SERVER['DOCUMENT_ROOT'].'/app/Core/Route.php';

$allRoutes = require $_SERVER['DOCUMENT_ROOT'].'/routes/routes.php';

use App\Core\Route as Route;

$route = new Route($_SERVER['REQUEST_URI']);

$route->startRoute($allRoutes);

