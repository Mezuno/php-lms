<div class="pagination">
	<div class="list-lists">

		<?php if(!($_GET['list'] < 5)): ?>
			<a href="/php-app/?list=<?= $_GET['list']-4 ?>"><?= $_GET['list']-4 ?></a>
		<?php endif ?>
		<?php if(!($_GET['list'] < 4)): ?>
			<a href="/php-app/?list=<?= $_GET['list']-3 ?>"><?= $_GET['list']-3 ?></a>
		<?php endif ?>
		<?php if(!($_GET['list'] < 3)): ?>
			<a href="/php-app/?list=<?= $_GET['list']-2 ?>"><?= $_GET['list']-2 ?></a>
		<?php endif ?>
		<?php if(!($_GET['list'] < 2)): ?>
			<a href="/php-app/?list=<?= $_GET['list']-1 ?>"><?= $_GET['list']-1 ?></a>
		<?php endif ?>

			<a class="red" href="/php-app/?list=<?= $_GET['list'] ?>"><?= $_GET['list'] ?></a>

		<?php if(!($_GET['list']+2 > $usersCount['count(*)'] / $paginationStep)): ?>
			<a href="/php-app/?list=<?= $_GET['list']+1 ?>"><?= $_GET['list']+1 ?></a>
		<?php endif ?>
		<?php if(!($_GET['list']+3 > $usersCount['count(*)'] / $paginationStep)): ?>
			<a href="/php-app/?list=<?= $_GET['list']+2 ?>"><?= $_GET['list']+2 ?></a>
		<?php endif ?>
		<?php if(!($_GET['list']+4 > $usersCount['count(*)'] / $paginationStep)): ?>
			<a href="/php-app/?list=<?= $_GET['list']+3 ?>"><?= $_GET['list']+3 ?></a>
		<?php endif ?>
		<?php if(!($_GET['list']+5 > $usersCount['count(*)'] / $paginationStep)): ?>
			<a href="/php-app/?list=<?= $_GET['list']+4 ?>"><?= $_GET['list']+4 ?></a>
		<?php endif ?>

	</div>


	<form action="/php-app/">
		<input class="input-lists-count" type="number" placeholder="Кол-во записей на странице" name="paginationStep">
		<button class="rounded-button" type="submit">Установить</button>
	</form>
	<form action="/php-app/">
		<input class="input-lists-number" type="number" placeholder="Cтраница" name="list">
		<button class="rounded-button" type="submit">Перейти</button>
	</form>
</div>