<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/links.php';
require $connect_db_link;
require $get_auth_user_data_link;
require $check_access_admin_link;
require_once $create_n_users_link;

$pageName = 'Создание N пользователей';
require $header_link;
	
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