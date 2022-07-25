<?php

$userDataArray = $dataFromServer['usersData'];
$usersCount = $dataFromServer['usersCount'];
$paginationInfo = $dataFromServer['paginationParams'];
$authUserData = $dataFromServer['authUserData'];

if (isset($dataFromServer['deleteError'])) {
	$error = $dataFromServer['deleteError'];
}
if (isset($dataFromServer['deleteSuccess'])) {
	$success = $dataFromServer['deleteSuccess'];
}

require $_SERVER['DOCUMENT_ROOT'].'/config/links.php';

$pageName = 'Таблица пользователей';
require_once $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/header.php';

?>


<?php require_once 'components/cookie-notification.php' ?>

<div class="pagination">
	<div class="list-lists">

		<?php if ($paginationInfo['page'] > 5): ?>
			<a href="/users?limit=<?= $paginationInfo['limit'] ?>&page=1">1</a>
		<?php endif ?>

		<?php if ($paginationInfo['page']-5 > 1): ?>
			<a href="/users?limit=<?= $paginationInfo['limit'] ?>&page=<?= $paginationInfo['page']-5 ?>">...</a>
		<?php endif ?>

		<?php
			for ($i = 4; $i > 0; $i--) {
				if ($paginationInfo['page']-1 >= $i) {
					echo '<a href="/users?limit=' . $paginationInfo['limit'] . '&page=' . $paginationInfo['page']-$i  . '">' . $paginationInfo['page']-$i . '</a>';
				}
			}
		?>

		<a class="green" href="/users?limit=<?= $paginationInfo['limit'] ?>&page=<?= $paginationInfo['page'] ?>"><?= $paginationInfo['page'] ?></a>

		<?php
			for ($i = 1; $i <= 5; $i++) {
				if ($paginationInfo['page']+$i < ceil($usersCount['count(*)'] / $paginationInfo['limit'])) {
					echo '<a href="/users?limit=' . $paginationInfo['limit'] . '&page=' . $paginationInfo['page']+$i  . '">' . $paginationInfo['page']+$i . '</a>';
				}
			}
		?>

		<?php if ($paginationInfo['page']+5 < $usersCount['count(*)'] / $paginationInfo['limit']): ?>
			<a href="/users?limit=<?= $paginationInfo['limit'] ?>&page=<?= $paginationInfo['page']+5 ?>">...</a>
		<?php endif ?>

		<?php if (($paginationInfo['page'] != ceil($usersCount['count(*)'] / $paginationInfo['limit']))): ?>
			<a href="/users?limit=<?= $paginationInfo['limit'] ?>&page=<?= ceil($usersCount['count(*)'] / $paginationInfo['limit']) ?>">
				<?= ceil($usersCount['count(*)'] / $paginationInfo['limit']) ?>
			</a>
		<?php endif ?>

	</div>

	<div class="flex-row">
		<form action="/users">
			<input placeholder="Лимит" class="input-lists-count" type="number" max="100" name="limit">
			<button class="rounded-button" type="submit">Установить</button>
		</form>
		<form action="/users">
			<input placeholder="Cтраница" class="input-lists-number" type="number" name="page">
			<button class="rounded-button" type="submit">Перейти</button>
		</form>
	</div>

	<form class="search" action="/users?limit=<?= $paginationInfo['limit'] ?>&page=<?= $paginationInfo['page'] ?>">
		<?php if (isset($_GET['strToSearch'])): ?>
			<a href="/users?limit=<?= $paginationInfo['limit'] ?>&page=<?= $paginationInfo['page'] ?>" class="action-button"><i class="fas fa-x"></i></a>
		<?php endif ?>
		<input name="strToSearch" type="text" placeholder="Поиск" value="<?= $_GET['strToSearch'] ?? '' ?>">
		<button class="search-button"><i class="fas fa-search"></i></button>
	</form>
</div>


<table cellspacing="0px" cellpadding="10px" border-spacing="1" bordercolor="#606060">

	<?php

		include $table_header_html_link;

		foreach ($userDataArray as $key => $userData) {
			?>
				<tr>
					<td class="td-userdata">
						<?php if($userData['user_avatar_filename'] != NULL && file_exists($_SERVER['DOCUMENT_ROOT'].$userData['user_avatar_filename'])): ?>
							<a href="/users/<?= $userData['user_id']?>">
								<img class="td-img" src="<?= $userData['user_avatar_filename'] ?>?v=<?= time() ?>" alt="">
							</a>
							<?php else: ?>
							<a href="/users/<?= $userData['user_id']?>">
								<img class="td-img" src="<?= $default_avatar_link ?>?v=<?= time() ?>" alt="">
							</a>
						<?php endif ?>
					</td>

					<td class="td-userdata"><?= $userData['user_id'] ?></td>
					<td class="td-userdata"><?= $userData['user_email'] ?></td>
					<td class="td-userdata"><a href="/users/<?= $userData['user_id']?>"><?= $userData['user_login'] ?></a></td>
					<td class="td-userdata"><?= $userData['role_title'] ?></td>
					<td class="td-buttons">

					<?php if ((isset($_SESSION['user_token']) && $authUserData['role_id'] == 1)
					 || (isset($_SESSION['user_token']) && $authUserData['user_id'] == $userData['user_id'])): ?>

						<a class="action-button" href="/users/<?= $userData['user_id'] ?>/update"><i class="fa-solid fa-pen"></i></a>

						<?php if ($authUserData['role_id'] == 1): ?>
							<a class="action-button red" onclick="document.getElementById('delete-modal-<?= $userData['user_id'] ?>').style.display = 'flex'"><i class="fa-solid fa-trash"></i></a>
						<?php endif ?>

					<?php endif ?>

					</td>
				</tr>

				<div class="delete-modal" id="delete-modal-<?= $userData['user_id'] ?>">
					<p class="delete-modal-text mb20 mr20">Вы действительно хотите удалить пользователя id<?= $userData['user_id'] ?>?</p>
					<div class="flex-row">
						<a href="/users/<?= $userData['user_id'] ?>/delete" class="action-button mt20">Да</a>
						<a onclick="document.getElementById('delete-modal-<?= $userData['user_id'] ?>').style.display = 'none'" class="action-button ml20 mt20">Нет</a>
					</div>
				</div>

		<?php } ?>
	<!-- <div class="volume1"></div>
	<div class="volume2"></div>
	<div class="volume3"></div> -->

</table>

</body>
</html>
