<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/links.php';
require $create_course_link;

$pageName = 'Создание курса';
require $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/header.php';

?>


<div class="p20 flex-alit-center flex-just-center flex-row">
	<div class="p20-bg-rnd-container flex-col">

	<form class="create-form" action="" method="POST">
		<input type="text" value="<?= $title ?? '' ?>" name="title" placeholder="Название курса"><br>
		<input type="text" value="<?= $id ?>" name="id" hidden>
		<input type="submit" name="submit" value="Создать" class="rounded-button">
	</form>


	<?php if(isset($createSuccess)): ?>
		<div class="notification">
			<?php if (!$createSuccess): ?>
				<div class="red p8 fading">
					<?= $errorString ?>
				</div>
			<?php elseif($createSuccess): ?>
				<div class="green p8 fading">
					Курс успешно создан!
				</div>
			<?php endif ?>
		</div>
	<?php endif ?>
		<a href="/courses" class="rounded-button"><i class="fa-solid fa-arrow-left"></i> Все курсы</a>
	</div>
</div>

</body>
</html>