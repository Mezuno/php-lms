<?php

session_start();
require $check_auth_link;
require $connect_db_link;
require $verify_function_link;
require $get_auth_user_data_link;

if (!checkAuth()) {
	header('Location: /');
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
		$sql = "INSERT INTO courses (title_course, author_course) VALUES (?, ?)";
		$stmt = $db->prepare($sql);
		$stmt->execute([$title, $authUserData['id']]);
	
		$createSuccess = true;
	} else {
		$createSuccess = false;
	}
}
