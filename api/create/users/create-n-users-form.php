<?php

if (isset($_POST['submit'])) {
	require $_SERVER['DOCUMENT_ROOT'].'/includes/links.php';
	require $connect_db_link;
	require $get_auth_user_data_link;
	require $check_access_admin_link;
	
	$stmt = $db->query("SELECT id FROM `users` ORDER BY `id` DESC LIMIT 1");
	$row = $stmt->fetch();
	$id = $row['id'];
	$i = $id;
	
	$n = $_POST['countUsersToCreate'];
	
	while ($i <= $id+$n-1) {
		$email = 'pochta'.($i+1).'@mail.ru';
		$login = 'login'.$i+1;
		$password = 'password'.$i+1;
		$password = md5(md5($password."yalublulipton"));
	
		$db->query("INSERT INTO `users` (`email`,`login`, `password`) VALUES ('$email','$login', '$password')");
		$i++;
	}
	
	header('Location: /users');
	die();
}

	$pageName = 'Создание N пользователей';
	require $_SERVER['DOCUMENT_ROOT'].'/includes/header.php';
	require $check_access_admin_link;
	
?>


<div class="p20 flex-alit-center flex-just-center flex-row">
	<div class="p20-bg-rnd-container flex-col">
		<form class="flex-col mb20" action="#" method="post">
			<input class="mb20" type="number" value="10" name="countUsersToCreate" required>
			<input type="submit" name="submit" class="rounded-button" value="Добавить">
		</form>

		<?php if (isset($_COOKIE['createError'])): ?>
			<div id="message" class="red notification">
				<?= $_COOKIE['createError']; ?>
			</div>
		<?php endif ?>

		<a href="/users" class="rounded-button"><i class="fa-solid fa-arrow-left"></i> К списку</a>
	</div>
</div>

</body>
</html>