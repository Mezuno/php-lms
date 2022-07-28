<?php

$authUserData = $dataFromServer['authUserData'];
if (isset($dataFromServer['createErrors'])) {
	$createErrors = $dataFromServer['createErrors'];
}

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


	<?php if(isset($createErrors)) { ?>
		<?php foreach ($createErrors as $key => $value) { ?>
			<div class="red p8 fading notification">
				<?= $value ?>
			</div>
	<?php } } ?>
	
		<a href="/courses" class="rounded-button"><i class="fa-solid fa-arrow-left"></i> Все курсы</a>
	</div>
</div>

</body>
</html>