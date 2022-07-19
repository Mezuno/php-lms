<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/links.php';
require $update_user_link;

$pageName = 'Изменение пользователя id'.($id);
require $header_link;

?>


<div class="p20 flex-alit-center flex-just-center flex-row">
	<div class="p20-bg-rnd-container flex-col">

	<form class="create-form" action="" method="POST">
		<input type="email" value="<?= $email ?? $userDataFromDB['email'] ?>" name="email" placeholder="Email"><br>
		<input type="text" value="<?= $login ?? $userDataFromDB['login'] ?>" name="login" placeholder="Login"><br>
		<input type="text" name="password" placeholder="Password" autocomplete="off"><br>
		<input type="text" name="passwordRepeat" placeholder="Password repeat" autocomplete="off"><br>
		<input type="text" value="<?= $id ?>" name="id" hidden>
		<input type="submit" name="submit" value="Обновить" class="rounded-button">
	</form>


	<?php if(isset($changeSuccess)): ?>
		<div class="notification">
			<?php if (!$changeSuccess): ?>
				<div class="red p8 fading">
					<?= $errorString ?>
				</div>
			<?php elseif($changeSuccess): ?>
				<div class="green p8 fading">
					Пользователь под id<?= $userDataFromDB['id'] ?> успешно обновлён!
				</div>
			<?php endif ?>
		</div>
	<?php endif ?>
		<a href="/users/<?= $userDataFromDB['id'] ?>" class="rounded-button mb20"><i class="fa-solid fa-arrow-left"></i> В профиль</a>
		<a href="/users" class="rounded-button"><i class="fa-solid fa-arrow-left"></i> К списку</a>
	</div>
</div>

</body>
</html>