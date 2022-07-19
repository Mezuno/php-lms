<?php

require $connect_db_link;
require $check_auth_link;
require $check_course_owner_link;
require $get_auth_user_data_link;
require $get_user_data_by_id_function_link;

if (!checkAuth()) {
    header('Location: /');
    die;
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

if (!checkCourseOwner($courseDataFromDB['id_course'], $authUserData['id'], $db)) {
	header('Location: /');
    die;
}
