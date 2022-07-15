<?php

// КОСТЫЛЬ

if ((substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1)) != '') {
	$_GET['list'] = substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1);
} else {
	$_GET['list'] = 1;
}

// 



if (isset($_GET['paginationStep'])) $_SESSION['paginationStep'] = $_GET['paginationStep'];

if (!isset($_SESSION['paginationStep']) || $_SESSION['paginationStep'] > 100 || $_GET['paginationStep'] == '') {
	$paginationStep = 10;
	$_SESSION['paginationStep'] = $paginationStep;
} 
else $paginationStep = $_SESSION['paginationStep'];


if (!isset($_GET['list'])) $_GET['list'] = $_SESSION['list'];

if (!isset($_SESSION['list'])) $_GET['list'] = 1;

if (isset($_GET['list'])) $_SESSION['list'] = $_GET['list'];

$usersCountResult = $db->query("SELECT count(*) FROM users WHERE `deleted_at` IS NULL");
$usersCount = $usersCountResult->fetch();


if ($_GET['list'] > $usersCount['count(*)'] / $paginationStep) 
$_GET['list'] = ceil($usersCount['count(*)'] / $paginationStep);

if ($_GET['list'] < 1)
$_GET['list'] = 1;
