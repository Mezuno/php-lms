<?php

$coursesDataArray = $dataFromServer['coursesData'];
$coursesCount = $dataFromServer['coursesCount'];
$paginationInfo = $dataFromServer['paginationParams'];
$authUserData = $dataFromServer['authUserData'];
$pageName = $dataFromServer['pageName'];

require_once $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/header.php';

?>


<?php require_once 'components/cookie-notification.php' ?>

<div class="pagination">
	<div class="list-lists">

		<?php if ($paginationInfo['page'] > 5): ?>
			<a href="/courses?limit=<?= $paginationInfo['limit'] ?>&page=1">1</a>
		<?php endif ?>

		<?php if ($paginationInfo['page']-5 > 1): ?>
			<a href="/courses?limit=<?= $paginationInfo['limit'] ?>&page=<?= $paginationInfo['page']-5 ?>">...</a>
		<?php endif ?>

		<?php
			for ($i = 4; $i > 0; $i--) {
				if ($paginationInfo['page']-1 >= $i) {
					echo '<a href="/courses?limit=' . $paginationInfo['limit'] . '&page=' . $paginationInfo['page']-$i  . '">' . $paginationInfo['page']-$i . '</a>';
				}
			}
		?>

		<a class="current-page" href="/courses?limit=<?= $paginationInfo['limit'] ?>&page=<?= $paginationInfo['page'] ?>"><?= $paginationInfo['page'] ?></a>

		<?php
			for ($i = 1; $i <= 5; $i++) {
				if ($paginationInfo['page']+$i < ceil($coursesCount['count(*)'] / $paginationInfo['limit'])) {
					echo '<a href="/courses?limit=' . $paginationInfo['limit'] . '&page=' . $paginationInfo['page']+$i  . '">' . $paginationInfo['page']+$i . '</a>';
				}
			}
		?>

		<?php if ($paginationInfo['page']+5 < $coursesCount['count(*)'] / $paginationInfo['limit']): ?>
			<a href="/courses?limit=<?= $paginationInfo['limit'] ?>&page=<?= $paginationInfo['page']+5 ?>">...</a>
		<?php endif ?>

		<?php if (($paginationInfo['page'] != ceil($coursesCount['count(*)'] / $paginationInfo['limit']))): ?>
			<a href="/courses?limit=<?= $paginationInfo['limit'] ?>&page=<?= ceil($coursesCount['count(*)'] / $paginationInfo['limit']) ?>">
				<?= ceil($coursesCount['count(*)'] / $paginationInfo['limit']) ?>
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
		include $table_courses_header_html_link;

		foreach ($coursesDataArray as $key => $courseData) {
			?>
				<tr>
					<td class="td-userdata"></td>
					<td class="td-userdata"></td>
					<td class="td-userdata"><a href="/courses/<?= $courseData['course_id']?>"><?= $courseData['course_title'] ?></a></td>	
					<td class="td-userdata"><a href="/users/<?= $courseData['course_author']?>"><?= $courseData['user_login'] ?></a></td>
					<td class="td-userdata"><b></b></td>
					<td class="td-buttons">

					<?php if ($authUserData['user_id'] == $courseData['course_author'] || $authUserData['role_title'] == 'Admin'): ?>

					<a class="action-button" href="/courses/<?= $courseData['course_id'] ?>/update"><i class="fa-solid fa-pen"></i></a>

						<?php if ($courseData['course_deleted_at'] != NULL): ?>
						<a class="action-button yellow" onclick="
							document.getElementById('recovery-modal-<?= $courseData['course_id'] ?>').style.display = 'flex'
							">
							<i class="fa-solid fa-arrow-rotate-right"></i>
						</a>
						<?php else: ?>
						<a class="action-button red" onclick="
							document.getElementById('delete-modal-<?= $courseData['course_id'] ?>').style.display = 'flex'
							">
							<i class="fa-solid fa-trash"></i>
						</a>
						<?php endif ?>

					<?php endif ?>

					</td> <!-- td-buttons end -->
				</tr>

				<?php if ($courseData['course_deleted_at'] != NULL &&
				($courseData['course_author'] == $authUserData['user_id']
				|| $authUserData['role_title'] == 'Admin')): ?>

				<div class="recovery-modal" id="recovery-modal-<?= $courseData['course_id'] ?>">
					<p class="recovery-modal-text mb20 mr20">Вы действительно хотите восстановить курс <?= $courseData['course_title'] ?>?</p>
					<div class="flex-row">
						<a href="/courses/<?= $courseData['course_id'] ?>/recovery" class="action-button mt20">Да</a>
						<a onclick="document.getElementById('recovery-modal-<?= $courseData['course_id'] ?>').style.display = 'none'" class="action-button ml20 mt20">Нет</a>
					</div>
				</div>

				<?php elseif (($courseData['course_author'] == $authUserData['user_id']
				|| $authUserData['role_title'] == 'Admin')): ?>

				<div class="delete-modal" id="delete-modal-<?= $courseData['course_id'] ?>">
					<p class="delete-modal-text mb20 mr20">Вы действительно хотите удалить курс <?= $courseData['course_title'] ?>?</p>
					<div class="flex-row">
						<a href="/courses/<?= $courseData['course_id'] ?>/delete" class="action-button mt20">Да</a>
						<a onclick="document.getElementById('delete-modal-<?= $courseData['course_id'] ?>').style.display = 'none'" class="action-button ml20 mt20">Нет</a>
					</div>
				</div>

				<?php endif ?>

			<?php
		}
	?>
	<!-- <div class="volume1"></div>
	<div class="volume2"></div>
	<div class="volume3"></div> -->
</table>

</body>
</html>
