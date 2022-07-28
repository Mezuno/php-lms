<?php

$authUserData = $dataFromServer['authUserData'];
$courseData = $dataFromServer['courseData'][0];
$courseContent = $dataFromServer['courseJson'] ?? [];
if (isset($dataFromServer['updateErrors'])) {
	$updateErrors = $dataFromServer['updateErrors'];
}

$pageName = 'Изменение курса '.($courseData['course_title']);
require $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/header.php';

?>

<?php include $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/cookie-notification.php'; ?>

<div class="bg-w80p-mt70 p20 brd-rd6">
	<div class="flex-row flex-just-spbtw">

	<div class="flex-col">
		<form method="POST" action="" class="mb20 flex-col w600">
			<input class="course__title-update mb20" type="text" placeholder="Название" name="course_title" value="<?= $courseData['course_title'] ?? '' ?>">

			<?php foreach ($courseContent as $key => $value) { ?>
			<div class="flex-row flex-just-spbtw mb20">

				<select class="w250" name="course_type<?= $value['id'] ?>" id="">

					<option value="Article" <?php if ($value['type'] == 'Article') echo 'selected' ?>>Заголовок</option>
					<option value="Text" <?php if ($value['type'] == 'Text') echo 'selected' ?>>Текст</option>
					<option value="Video" <?php if ($value['type'] == 'Video') echo 'selected' ?>>Видео</option>

				</select>

				<textarea class="course__content-update w250" type="text" name="course_content<?= $value['id'] ?>"><?= $value['content'] ?></textarea>

				<input type="text" name="field_id" value="<?= $value['id'] ?>" hidden>
				<button type="submit" class="action-button" name="delete_field_button"><i class="fas fa-x"></i></button>
			</div>
			<?php } ?>

			<div class="add-field-to-course-button rounded-button mb20" onclick="document.getElementById('add-field').style.display = 'flex'">Добавить контент</div>

			<button type="submit" name="update_button">Обновить курс</button>
		</form>

		<a href="/courses/<?= $courseData['course_id'] ?>" class="rounded-button mb20"><i class="fa-solid fa-arrow-left"></i> Вернуться к курсу</a>
		<a href="/courses" class="rounded-button "><i class="fa-solid fa-arrow-left"></i> Список курсов</a>
	</div>

	<?php if (isset($updateErrors)) {

		foreach ($updateErrors as $key => $value) {
			?><div class="red p8 fading"><?php
			echo $value.'<br><br>';
			?></div><?php
		}

	} ?>


	<div id="add-field" class="add-field-to-course">
		<form method="POST" action="" class="flex-col">
			<div class="add-field-to-course-title flex-row flex-just-spbtw">Добавление контента
				<div onclick="document.getElementById('add-field').style.display = 'none'" class="action-button">
					<i class="fas fa-x"></i>
				</div>
			</div>
			<p class="add-field-to-course-description">Тип контента:</p>
			<select class="w300 mb20" name="course_type" id="">
				<option value="Article">Заголовок</option>
				<option value="Text">Текст</option>
				<option value="Video" selected>Видео</option>
			</select>
			<p class="add-field-to-course-description">Контент:</p>
			<textarea class="add-field-to-course-textarea w300 mb20" type="text" name="course_content"></textarea>
			<button class="rounded-button" type="submit" name="add_field_button">Добавить</button>
		</form>
	</div>

	</div>
</div>

</body>
</html>