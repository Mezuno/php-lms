<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/links.php';
require_once $connect_db_link;
require_once $verify_function_link;
require_once $get_auth_user_data_link;
require_once $get_user_data_by_id_function_link;
require_once $check_access_admin_link;


extract($_POST);

if ($_POST['submit']) {

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

	$pageName = 'Создание пользователя';
	require_once $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/header.php';
	
?>


<div class="p20 flex-alit-center flex-just-center flex-row">

	<div class="p20-bg-rnd-container flex-col">
		<form class="create-form" action="#" method="post">
			<input type="text" value="<?= $_POST['login'] ?>" name="login" placeholder="Login" autocomplete="off" required><br>
			<input type="email" value="<?= $_POST['email'] ?>" name="email" placeholder="E-mail" autocomplete="off" required><br>
			<input type="password" name="password" placeholder="Password" autocomplete="off" required><br>
			<input type="password" name="passwordRepeat" placeholder="Password" autocomplete="off" required><br>
			<input type="number" value="<?= $_POST['title_role'] ?>" name="role" placeholder="Role" autocomplete="off" required><br>
			<input type="submit" name="submit" class="rounded-button" value="Добавить">
		</form>

		<div class="notification">
		<?php if (!$createSuccess && isset($createSuccess)): ?>
			<div class="red p8 fading">
				<?= $errorString ?>
			</div>
		<?php elseif($createSuccess): ?>
			<div class="green p8 fading">
				Пользователь <?= $login ?> успешно создан!
			</div>
		<?php endif ?>
		</div>

		<a href="/php-app/" class="rounded-button"><i class="fa-solid fa-arrow-left"></i> На главную</a>
	</div>
</div>




</body>
</html>