<?php

$coursesDataArray = $dataFromServer['coursesData'];
$coursesCount = $dataFromServer['coursesCount'];
$paginationInfo = $dataFromServer['paginationParams'];
$authUserData = $dataFromServer['authUserData'];

$pageName = 'Список курсов';
require_once $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/header.php';

include $cookie_error_link;

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

		<a class="green" href="/courses?limit=<?= $paginationInfo['limit'] ?>&page=<?= $paginationInfo['page'] ?>"><?= $paginationInfo['page'] ?></a>

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

						<a class="action-button" href="/courses/<?= $courseData['course_id'] ?>/update"><i class="fa-solid fa-pen"></i></a>

						<a class="action-button red" onclick="
							document.getElementById('delete-modal-<?= $courseData['course_id'] ?>').style.display = 'flex'
							">
							<i class="fa-solid fa-trash"></i>
						</a>

					</td> <!-- td-buttons end -->
				</tr>

				<div class="delete-modal" id="delete-modal-<?= $courseData['course_id'] ?>">
					<p class="delete-modal-text mb20 mr20">Вы действительно хотите удалить курс <?= $courseData['course_title'] ?>?</p>
					<div class="flex-row">
						<a href="/courses/<?= $courseData['course_id'] ?>/delete" class="action-button mt20">Да</a>
						<a onclick="document.getElementById('delete-modal-<?= $courseData['course_id'] ?>').style.display = 'none'" class="action-button ml20 mt20">Нет</a>
					</div>
				</div>

			<?php
		}
	?>
	<!-- <div class="volume1"></div>
	<div class="volume2"></div>
	<div class="volume3"></div> -->
</table>

</body>
</html>
