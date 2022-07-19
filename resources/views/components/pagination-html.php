<div class="pagination">
	<div class="list-lists">


	<?php $entity = $paginationEntity; ?>


	<?php if ($_SESSION['list'] > 5): ?>
		<a href="/<?= $entity ?>/list/1">1</a>
	<?php endif ?>

	<?php if ($_SESSION['list']-5 > 1): ?>
		<a href="/<?= $entity ?>/list/<?= $_SESSION['list']-5 ?>">...</a>
	<?php endif ?>

		<?php
			
			$i = 4;
			while ($i > 0) {
				if ($_SESSION['list']-1 >= $i) {
					echo '<a href="/' . $entity . '/list/' . $_SESSION['list']-$i  . '">' . $_SESSION['list']-$i . '</a>';
				}
				$i--;
			}
		
		?>

			<a class="green" href="/<?= $entity ?>/list/<?= $_SESSION['list'] ?>"><?= $_SESSION['list'] ?></a>
			
		<?php

			$i = 1;
			while ($i < 5) {
				if ($_SESSION['list']+$i < $entityCount['count(*)'] / $paginationStep) {
					echo '<a href="/' . $entity . '/list/' . $_SESSION['list']+$i  . '">' . $_SESSION['list']+$i . '</a>';
				}
				$i++;
			}
		
		?>

		<?php if ($_SESSION['list']+5 < $entityCount['count(*)'] / $paginationStep): ?>
			<a href="/<?= $entity ?>/list/<?= $_SESSION['list']+5 ?>">...</a>
		<?php endif ?>

		<?php if (($_SESSION['list'] != ceil($entityCount['count(*)'] / $paginationStep))): ?>
			<a href="/<?= $entity ?>/list/<?= ceil($entityCount['count(*)'] / $paginationStep) ?>">
				<?= ceil($entityCount['count(*)'] / $paginationStep) ?>
			</a>
		<?php endif ?>

	</div>

	<div class="flex-row">
		<form action="/<?= $entity ?>">
			<input placeholder="Лимит" class="input-lists-count" type="number" max="100" name="paginationStep">
			<button class="rounded-button" type="submit">Установить</button>
		</form>
		<form action="/<?= $entity ?>">
			<input placeholder="Cтраница" class="input-lists-number" type="number" name="list">
			<button class="rounded-button" type="submit">Перейти</button>
		</form>
	</div>

	<form class="search" action="/<?= $entity ?>/list/<?= $_SESSION['list'] ?>">
		<?php if (isset($_GET['strToSearch'])): ?>
			<a href="/<?= $entity ?>/list/<?= $_SESSION['list'] ?>" class="action-button"><i class="fas fa-x"></i></a>
		<?php endif ?>
		<input name="strToSearch" type="text" placeholder="Поиск" value="<?= $_GET['strToSearch'] ?? '' ?>">
		<button class="search-button"><i class="fas fa-search"></i></button>
	</form>
</div>
