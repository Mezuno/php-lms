<?php

$uri = $_SERVER['REQUEST_URI'];
$parseUri = explode('/', $uri);

$_POST['id'] = $parseUri[2];;

session_start();

require $_SERVER['DOCUMENT_ROOT'].'/includes/links.php';
require_once $connect_db_link;
$error = false;

$list = $_SESSION['list'];

if (!isset($_SESSION['token'])) {
	setcookie('logError', 'Сначала авторизируйтесь.', time()+1, '/');
	$linkToRedirect = '/login';
}

require $get_auth_user_data_link;

if ($_POST['id'] == $authUserData['id'] && !isset($linkToRedirect)) {
	setcookie('error', 'Зачем удалять себя?', time()+1, '/');
	$linkToRedirect = '/users/list/'.$list;
}

require $get_user_data_by_id_function_link;
$userData = getUserDataById($_POST['id'], $db);

if ($userData['id_role'] == 1 && !isset($linkToRedirect)) {
    setcookie('error', 'Нельзя удалить другого администратора.', time()+1, '/');
	$linkToRedirect = '/users/list/'.$list;
}

if ($authUserData['id_role'] != 1 && !isset($linkToRedirect)) {
    setcookie('error', 'У вас нету доступа.', time()+1, '/');
	$linkToRedirect = '/users/list/'.$list;
}

if (isset($_POST['id']) && !empty($_POST['id']) && $_POST['id'] != $authUserData['id']  && !isset($linkToRedirect)) {

	// Soft deletes
	$sql = "UPDATE users SET deleted_at = NOW() WHERE id = ?";
	$stmt = $db->prepare($sql);
	$stmt->execute([$_POST['id']]);

	// Обычное удаление
	// $sql = "DELETE FROM users WHERE id = ?";
	// $stmt = $db->prepare($sql);
	// $stmt->execute([$_POST['id']]);

	$linkToRedirect = '/users/list/'.$list;
}

header('Location: '.$linkToRedirect);
die();
