<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/links.php';
require_once $connect_db_link;
require_once $verify_function_link;
require_once $get_auth_user_data_link;
require_once $get_user_data_by_id_function_link;


extract($_POST);

if (!isset($id) || empty($id)) {
	header('Location: /php-app');
}

if($authUserData['id'] != $id) {
	require_once $check_access_admin_link;
}


if ($_POST['submit']) {

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
		$password = md5(md5($_POST['password']."yalublulipton"));
		$db->query("UPDATE `users` SET `email` = '$email', `login` = '$login', `password` = '$password' WHERE `id` = '$id'");
		$changeSuccess = true;
	} else {
		$changeSuccess = false;
	}

} else {
	$userDataFromDB = getUserDataById($id, $db);
}

$pageName = 'Изменение пользователя id'.($_POST['id']);
require $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/header.php';

?>


<div class="p20 flex-alit-center flex-just-center flex-row">
	<div class="p20-bg-rnd-container flex-col">

	<form class="create-form" action="" method="POST">
		<input type="email" value="<?= $email ?? $userDataFromDB['email'] ?>" name="email" placeholder="Email"><br>
		<input type="text" value="<?= $login ?? $userDataFromDB['login'] ?>" name="login" placeholder="Login"><br>
		<input type="text" name="password" placeholder="Password" autocomplete="off"><br>
		<input type="text" name="passwordRepeat" placeholder="Password repeat" autocomplete="off"><br>
		<input type="text" value="<?= $_POST['id'] ?>" name="id" hidden>
		<input type="submit" name="submit" value="Обновить" class="rounded-button">
	</form>

	<div class="notification">
	<?php if (!$changeSuccess && isset($changeSuccess)): ?>
		<div class="red p8 fading">
			<?= $errorString ?>
		</div>
	<?php elseif($changeSuccess): ?>
		<div class="green p8 fading">
			Пользователь под id<?= $userDataFromDB['id'] ?> успешно обновлён!
		</div>
	<?php endif ?>
	</div>
		<a onclick="javascript:history.back(); return false;" class="rounded-button"><i class="fa-solid fa-arrow-left"></i> Назад</a>
	</div>
</div>

</body>
</html>