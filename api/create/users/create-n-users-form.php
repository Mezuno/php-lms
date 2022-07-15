<?php

	$pageName = 'Создание пользователя';
	require $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/header.php';
	require $check_access_admin_link;
	
?>


<div class="pl20">
	<form action="<?= $create_n_users_link ?>" method="get">
		<input type="number" value="10" name="countUsersToCreate" required>
		<input type="submit" name="submit" class="rounded-button" value="Добавить">
	</form>

	<div id="message" class="red notification"><?php if (isset($_COOKIE['createError'])) echo $_COOKIE['createError']; ?></div>
</div>



<a href="/php-app/" class="rounded-button"><i class="fa-solid fa-arrow-left"></i> На главную</a>

</body>
</html>