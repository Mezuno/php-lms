<?php

$entity = $paginationEntity;

// if (isset($_GET['strToSearch'])) {
// 	$strToSearch = $_GET['strToSearch'];
// 	$itemsCountResult = $db->query("SELECT count(*) FROM $entity WHERE `deleted_at` IS NULL
// 	AND ((`id` LIKE '%$strToSearch%') OR (`login` LIKE '%$strToSearch%') OR (`email` LIKE '%$strToSearch%'))");
// 	$addToUriStrToSearch = '?strToSearch='.$_GET['strToSearch'];
// } else {
	if ($entity == 'users') {
		$itemsCountResult = $db->query("SELECT count(*) FROM $entity WHERE `deleted_at` IS NULL");
	}
	if ($entity == 'courses') {
		$userId = $authUserData['id'];
		$itemsCountResult = $db->query("SELECT count(*) FROM $entity WHERE `deleted_at_course` IS NULL
		AND author_course = $userId");

	}
// }
$entityCount = $itemsCountResult->fetch();


if (isset($_GET['paginationStep']) && !empty($_GET['paginationStep'])) {
	$_SESSION['paginationStep'] = $_GET['paginationStep'];
	$paginationStep = $_GET['paginationStep'];
	header('Location: /' . $entity . '/list/' . $_SESSION['list'].$addToUriStrToSearch);
	die();
} else {
	if (isset($_SESSION['paginationStep']) && $_SESSION['paginationStep'] <= 100) {
		$paginationStep = $_SESSION['paginationStep'];
	} else {
		$paginationStep = 10;
	}
}

if (isset($_GET['list'])) {

	if ($_GET['list'] > $entityCount['count(*)'] / $paginationStep) {
		$_GET['list'] = ceil($entityCount['count(*)'] / $paginationStep);
		$_SESSION['list'] = $_GET['list'];
		header('Location: /' . $entity . '/list/'.$_SESSION['list'].$addToUriStrToSearch);
		die();
	}

	if ($_GET['list'] < 0) {
		$_GET['list'] = 1;
		$_SESSION['list'] = $_GET['list'];
		header('Location: /' . $entity . '/list/'.$_SESSION['list'].$addToUriStrToSearch);
		die();
	}

	$_SESSION['list'] = $_GET['list'];
	header('Location: /' . $entity . '/list/'.$_SESSION['list'].$addToUriStrToSearch);
	die();

} else {

	// КОСТЫЛЬ

	$listFromUri = substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1);

	if (is_numeric($listFromUri)) {

		if ($listFromUri > ceil($entityCount['count(*)'] / $paginationStep)) {

			$_SESSION['list'] = ceil($entityCount['count(*)'] / $paginationStep);
			header('Location: /' . $entity . '/list/'.$_SESSION['list'].$addToUriStrToSearch);
			die();
		}

		if ($listFromUri < 1) {
			$listFromUri = 1;
			$_SESSION['list'] = $listFromUri;
			header('Location: /' . $entity . '/list/'.$_SESSION['list'].$addToUriStrToSearch);
			die();
		}


		$_SESSION['list'] = $listFromUri;

	} else {

		if (isset($_SESSION['list'])) {
			if ($_SESSION['list'] > ceil($entityCount['count(*)'] / $paginationStep)) {
				$_SESSION['list'] = ceil($entityCount['count(*)'] / $paginationStep);
				header('Location: /' . $entity . '/list/'.$_SESSION['list'].$addToUriStrToSearch);
				die();
			} else {
				$_GET['list'] = $_SESSION['list'];
			}
		} else {
			$_GET['list'] = 1;
			$_SESSION['list'] = 1;
		}
	}

	
}
