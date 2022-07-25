<?php

$authUserData = $dataFromServer['authUserData'];
$inputData = $dataFromServer['inputData'];
$userData = $dataFromServer['userData'];
$updateErrors = $dataFromServer['updateErrors'];
$updateSuccess = $dataFromServer['updateSuccess'];

$pageName = 'Изменение пользователя id'.($userData['user_id']);
require $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/header.php';

?>


<div class="p20 flex-alit-center flex-just-center flex-row">
	<div class="p20-bg-rnd-container flex-col">

	<form class="create-form" action="" method="POST">
		<input type="email" value="<?= $inputData['email'] ?? $userData['user_email'] ?>" name="email" placeholder="Email"><br>
		<input type="text" value="<?= $inputData['login'] ?? $userData['user_login'] ?>" name="login" placeholder="Login"><br>
		<input type="text" name="password" placeholder="Password" autocomplete="off"><br>
		<input type="text" name="passwordRepeat" placeholder="Password repeat" autocomplete="off"><br>
		<input type="text" value="<?= $id ?>" name="id" hidden>
		<input type="submit" name="submit" value="Обновить" class="rounded-button">
	</form>


	<?php if(!empty($updateErrors) || $updateSuccess): ?>
		<div class="notification">
			<?php if ($updateErrors): foreach ($updateErrors as $key => $value) {?>
				<div class="red p8 fading">
					<?= $value ?>
				</div>
			<?php } elseif($updateSuccess): ?>
				<div class="green p8 fading">
					Пользователь под id<?= $userData['user_id'] ?> успешно обновлён!
				</div>
			<?php endif ?>
		</div>
	<?php endif ?>
		<a href="/users/<?= $userData['user_id'] ?>" class="rounded-button mb20"><i class="fa-solid fa-arrow-left"></i> В профиль</a>
		<a href="/users" class="rounded-button"><i class="fa-solid fa-arrow-left"></i> К списку</a>
	</div>
</div>

</body>
</html>