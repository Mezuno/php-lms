<?php

if ($_POST['submit']) {

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

	foreach ($inputData as $key => $value) {
		$errorsArray = verifyInputData($key, $inputData);
		foreach ($errorsArray as $err) $errorString = $errorString.$err;
	}

	if ($row = $db->query("SELECT id FROM `users` WHERE `login` = '$login'")->fetch()) {
		if ($row['id']) {
			$errorString = $errorString.'Пользователь с таким логином уже существует<br><br>';
		}
	}
	if ($row = $db->query("SELECT id FROM `users` WHERE `email` = '$email'")->fetch()) {
		if ($row['id']) {
			$errorString = $errorString.'Пользователь с таким Email уже существует<br><br>';
		}
	}
	
	if ($errorString == '') {
		$password = md5(md5($_POST['password']."yalublulipton"));
		$db->query("INSERT INTO `users` SET `email` = '$email', `login` = '$login', `password` = '$password', `roleid` = '$role'");
		$createSuccess = true;
	} else {
		$createSuccess = false;
	}

}
