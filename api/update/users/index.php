<?php

require $connect_db_link;
require $verify_function_link;
require $get_auth_user_data_link;
require $get_user_data_by_id_function_link;

$uri = $_SERVER['REQUEST_URI'];
$parseUri = explode('/', $uri);
$id = $parseUri[2];

if (!isset($id) || empty($id)) {
	header('Location: /');
    die;
}

if($authUserData['id'] != $id) {
	require_once $check_access_admin_link;
}

if (isset($_POST['submit'])) {

	$login = $_POST['login'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	$passwordRepeat = $_POST['passwordRepeat'];
	$role = $_POST['role'];

	$inputData = [
		'login' => $login,
		'email' => $email,
		'password' => $password,
		'passwordRepeat' => $passwordRepeat,
	];

	if ($password == '' && $passwordRepeat == '') {
		unset($inputData['password']);
		unset($inputData['passwordRepeat']);
	}

	foreach ($inputData as $key => $value) {
		$errorsArray = verifyInputData($key, $inputData);
		foreach ($errorsArray as $err) $errorString = $errorString.$err;
	}

	$userDataFromDB = getUserDataById($id, $db);

	if ($login != $userDataFromDB['login']) {
		$usersCountResult = $db->query("SELECT count(*) FROM users WHERE `login` = '$login'");
		$usersCount = $usersCountResult->fetch();
		if ($usersCount['count(*)'] != 0) {
			$errorString = $errorString.'Пользователь с таким логином уже существует<br><br>';
		}
	}
	if ($email != $userDataFromDB['email']) {
		$usersCountResult = $db->query("SELECT count(*) FROM users WHERE `email` = '$email'");
		$usersCount = $usersCountResult->fetch();
		if ($usersCount['count(*)'] != 0) {
			$errorString = $errorString.'Пользователь с таким Email уже существует<br>';
		}
	}
	
	if ($errorString == '') {
		
		if (!empty($password)) {
			$password = md5(md5($password."yalublulipton"));
			$db->query("UPDATE `users` SET `email` = '$email', `login` = '$login', `password` = '$password' WHERE `id` = '$id'");
		} else {
			$db->query("UPDATE `users` SET `email` = '$email', `login` = '$login' WHERE `id` = '$id'");
		}

		$changeSuccess = true;
	} else {
		$changeSuccess = false;
	}

} else {
	$userDataFromDB = getUserDataById($id, $db);
}
