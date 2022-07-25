<?php

session_start();

require $check_auth_link;
require $connect_db_link;
require $check_course_owner_link;
require $verify_function_link;
require $get_user_data_by_id_function_link;

if (!checkAuth()) {
	header('Location: /');
	die;
} else {
	require $get_auth_user_data_link;
}

$uri = $_SERVER['REQUEST_URI'];
$parseUri = explode('/', $uri);
$courseId = $parseUri[2];

if (!isset($courseId) || empty($courseId) || !is_numeric($courseId)) {
	header('Location: /resources/views/404.php');
    die;
} else {
	$courseDataFromDB = getCourseDataById($courseId, $db);
}

if (!checkCourseOwner($courseId, $authUserData['id'], $db)) {
	setcookie('error', 'Куууудааа мы лезем? Нельзя менять чужие курсы.', time()+1, '/');
	header('Location: /courses');
	die;
}

if (isset($_POST['submit'])) {

	$title = $_POST['title'];
	$errorString = '';

	$inputData = [
		'title_course' => $title,
	];

	foreach ($inputData as $key => $value) {
		$errorsArray = verifyInputData($key, $inputData);
		foreach ($errorsArray as $err) $errorString = $errorString.$err;
	}

	if ($errorString == '') {
		$sql = "UPDATE courses SET title_course = ? WHERE id_course = ?";
		$stmt = $db->prepare($sql);
		$stmt->execute([$title, $courseId]);
	
		$changeSuccess = true;
	} else {
		$changeSuccess = false;
	}
}
