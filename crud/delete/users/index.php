<?php

extract($_POST);
session_start();

require_once $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/links.php';
require_once $connect_db_link;
require_once $pagination_link;
$error = false;

if (!isset($_SESSION['token'])) {
	setcookie('logError', 'Сначала авторизируйтесь.', time()+1, '/php-app');
	$linkToRedirect = $auth_user_form_link;
}

require_once $get_auth_user_data_link;

if ($authUserData['id_role'] != 1 && !isset($linkToRedirect)) {
    setcookie('error', 'У вас нету доступа.', time()+5, '/php-app');
	$linkToRedirect = '/php-app';
}

if ($id == $authUserData['id'] && !isset($linkToRedirect)) {
	setcookie('error', 'Зачем удалять себя?', time()+1, '/php-app');
	$linkToRedirect = '/php-app';
}

if (isset($id) && !empty($id) && $id != $authUserData['id']  && !isset($linkToRedirect)) {

	
	// Soft deletes
	$sql = "UPDATE users SET deleted_at = NOW() WHERE id = ?";
	$stmt = $db->prepare($sql);
	$stmt->execute([$id]);

	// Обычное удаление
	// $sql = "DELETE FROM users WHERE id = ?";
	// $stmt = $db->prepare($sql);
	// $stmt->execute([$id]);

	$linkToRedirect = '/php-app/?list='.$list;

}

header('Location: '.$linkToRedirect);
die();
	