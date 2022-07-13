<?php

if (isset($_GET['paginationStep'])) $_SESSION['paginationStep'] = $_GET['paginationStep'];

if (!isset($_SESSION['paginationStep']) || $_SESSION['paginationStep'] > 100 || $_GET['paginationStep'] == '') {
	$paginationStep = 10;
	$_SESSION['paginationStep'] = $paginationStep;
} 
else $paginationStep = $_SESSION['paginationStep'];


if (!isset($_GET['list'])) $_GET['list'] = 1;

$usersCountResult = $db->query("SELECT count(*) FROM users WHERE `deleted_at` IS NULL");
$usersCount = $usersCountResult->fetch();


if ($_GET['list'] > $usersCount['count(*)'] / $paginationStep) 
$_GET['list'] = floor($usersCount['count(*)'] / $paginationStep)-1;

if ($_GET['list'] < 1)
$_GET['list'] = 1;
