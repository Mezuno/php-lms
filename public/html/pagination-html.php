<div class="pagination">
	<div class="list-lists">



	<?php if ($_SESSION['list'] > 5): ?>
		<a href="/users/list/1">1</a>
	<?php endif ?>

	<?php if ($_SESSION['list']-5 > 1): ?>
		<a href="/users/list/<?= $_SESSION['list']-5 ?>">...</a>
	<?php endif ?>

		<?php
			
			$i = 4;
			while ($i > 0) {
				if ($_SESSION['list']-1 >= $i) {
					echo '<a href="/users/list/' . $_SESSION['list']-$i  . '">' . $_SESSION['list']-$i . '</a>';
				}
				$i--;
			}
		
		?>

			<a class="green" href="/users/list/<?= $_SESSION['list'] ?>"><?= $_SESSION['list'] ?></a>

		<?php
			
			$i = 1;
			while ($i < 5) {
				if ($_SESSION['list']+$i < $usersCount['count(*)'] / $paginationStep) {
					echo '<a href="/users/list/' . $_SESSION['list']+$i  . '">' . $_SESSION['list']+$i . '</a>';
				}
				$i++;
			}
		
		?>

		<?php if ($_SESSION['list']+5 < $usersCount['count(*)'] / $paginationStep): ?>
			<a href="/users/list/<?= $_SESSION['list']+5 ?>">...</a>
		<?php endif ?>

		<?php if (($_SESSION['list'] != ceil($usersCount['count(*)'] / $paginationStep))): ?>
			<a href="/users/list/<?= ceil($usersCount['count(*)'] / $paginationStep) ?>">
				<?= ceil($usersCount['count(*)'] / $paginationStep) ?>
			</a>
		<?php endif ?>

	</div>

	<div class="flex-row">
		<form action="/users">
			<input placeholder="Лимит" class="input-lists-count" type="number" max="100" name="paginationStep">
			<button class="rounded-button" type="submit">Установить</button>
		</form>
		<form action="/users">
			<input placeholder="Cтраница" class="input-lists-number" type="number" name="list">
			<button class="rounded-button" type="submit">Перейти</button>
		</form>
	</div>
</div>
