<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/links.php';
require $update_course_link;

$pageName = 'Изменение курса '.($courseDataFromDB['title_course']);
require $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/header.php';

?>


<div class="p20 flex-alit-center flex-just-center flex-row">
	<div class="p20-bg-rnd-container flex-col">

	<form class="create-form" action="" method="POST">
		<input type="text" value="<?= $title ?? $courseDataFromDB['title_course'] ?>" name="title" placeholder="Название курса"><br>
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
					Курс <?= $courseDataFromDB['id_course'] ?> успешно обновлён!
				</div>
			<?php endif ?>
		</div>
	<?php endif ?>
		<a href="/courses/<?= $courseDataFromDB['id_course'] ?>" class="rounded-button mb20"><i class="fa-solid fa-arrow-left"></i> Посмотреть курс</a>
		<a href="/courses" class="rounded-button"><i class="fa-solid fa-arrow-left"></i> Все курсы</a>
	</div>
</div>

</body>
</html>