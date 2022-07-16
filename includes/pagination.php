<?php

if (isset($_GET['paginationStep'])) {
	$_SESSION['paginationStep'] = $_GET['paginationStep'];
	$paginationStep = $_GET['paginationStep'];
	header('Location: /users/list/'.$_SESSION['list']);
	die();
} else {
	if (isset($_SESSION['paginationStep']) && $_SESSION['paginationStep'] <= 100) {
		$paginationStep = $_SESSION['paginationStep'];
	} else {
		$paginationStep = 10;
	}
}


$usersCountResult = $db->query("SELECT count(*) FROM users WHERE `deleted_at` IS NULL");
$usersCount = $usersCountResult->fetch();

if (isset($_GET['list'])) {

	if ($_GET['list'] > $usersCount['count(*)'] / $paginationStep) {
		$_GET['list'] = ceil($usersCount['count(*)'] / $paginationStep);
		$_SESSION['list'] = $_GET['list'];
		header('Location: /users/list/'.$_SESSION['list']);
		die();
	}

	if ($_GET['list'] < 0) {
		$_GET['list'] = 1;
		$_SESSION['list'] = $_GET['list'];
		header('Location: /users/list/'.$_SESSION['list']);
		die();
	}

	$_SESSION['list'] = $_GET['list'];
	header('Location: /users/list/'.$_SESSION['list']);
	die();

} else {

	// КОСТЫЛЬ

	$listFromUri = substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1);

	if (is_numeric($listFromUri)) {

		if ($listFromUri > ceil($usersCount['count(*)'] / $paginationStep)) {

			$_SESSION['list'] = ceil($usersCount['count(*)'] / $paginationStep);
			header('Location: /users/list/'.$_SESSION['list']);
			die();
		}

		if ($listFromUri < 1) {
			$listFromUri = 1;
			$_SESSION['list'] = $listFromUri;
			header('Location: /users/list/'.$_SESSION['list']);
			die();
		}


		$_SESSION['list'] = $listFromUri;

	} else {

		if (isset($_SESSION['list'])) {
			$_GET['list'] = $_SESSION['list'];
		} else {
			$_GET['list'] = 1;
			$_SESSION['list'] = 1;
		}
	}

	
}
