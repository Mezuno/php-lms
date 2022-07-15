<?php

require $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/links.php';

require_once $start_route_function_link;

$routes = require_once('routes.php');

startRoute($routes);

die();

// ini_set('error_reporting', E_ALL);
// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
