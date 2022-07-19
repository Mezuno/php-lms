<?php

$uri = $_SERVER['REQUEST_URI'];
$parseUri = explode('/', $uri);

if (is_numeric($parseUri[2])) {
    $courseToDeleteId = $parseUri[2];
}

session_start();

require $_SERVER['DOCUMENT_ROOT'].'/config/links.php';
require_once $connect_db_link;

$list = $_SESSION['list'];

if (!isset($_SESSION['token'])) {
	setcookie('logError', 'Сначала авторизируйтесь.', time()+1, '/');
	$linkToRedirect = '/login';
}

require $get_auth_user_data_link;
$authUserId = $authUserData['id'];

$resultQuery = $db->query("SELECT * FROM courses
                WHERE deleted_at_course IS NULL
                AND author_course = $authUserId
                AND id_course = $courseToDeleteId");

$authUserCourseData = $resultQuery->fetch();

if (!$authUserCourseData) {
    setcookie('error', 'Куууудааа мы лезем? Нельзя удалять чужие курсы.', time()+1, '/');
	$linkToRedirect = '/courses/list/'.$list;
} else {
	$sql = "UPDATE courses SET deleted_at_course = NOW() WHERE id_course = ?";
	$stmt = $db->prepare($sql);
	$stmt->execute([$courseToDeleteId]);

    setcookie('success', 'Курс ' . $authUserCourseData['title_course'] . ' успешно удалён.', time()+1, '/');
	$linkToRedirect = '/courses/list/'.$list;
}

header('Location: '.$linkToRedirect);
die;
