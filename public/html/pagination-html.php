<div class="pagination">
	<div class="list-lists">

		<?php if(!($_SESSION['list'] < 5)): ?>
			<a href="/users/list/<?= $_SESSION['list']-4 ?>"><?= $_SESSION['list']-4 ?></a>
		<?php endif ?>
		<?php if(!($_SESSION['list'] < 4)): ?>
			<a href="/users/list/<?= $_SESSION['list']-3 ?>"><?= $_SESSION['list']-3 ?></a>
		<?php endif ?>
		<?php if(!($_SESSION['list'] < 3)): ?>
			<a href="/users/list/<?= $_SESSION['list']-2 ?>"><?= $_SESSION['list']-2 ?></a>
		<?php endif ?>
		<?php if(!($_SESSION['list'] < 2)): ?>
			<a href="/users/list/<?= $_SESSION['list']-1 ?>"><?= $_SESSION['list']-1 ?></a>
		<?php endif ?>

			<a class="green" href="/users/list/<?= $_SESSION['list'] ?>"><?= $_SESSION['list'] ?></a>

		<?php if ($_SESSION['list']+1 < $usersCount['count(*)'] / $paginationStep): ?>
			<a href="/users/list/<?= $_SESSION['list']+1 ?>"><?= $_SESSION['list']+1 ?></a>
		<?php endif ?>
		<?php if ($_SESSION['list']+2 < $usersCount['count(*)'] / $paginationStep): ?>
			<a href="/users/list/<?= $_SESSION['list']+2 ?>"><?= $_SESSION['list']+2 ?></a>
		<?php endif ?>
		<?php if ($_SESSION['list']+3 < $usersCount['count(*)'] / $paginationStep): ?>
			<a href="/users/list/<?= $_SESSION['list']+3 ?>"><?= $_SESSION['list']+3 ?></a>
		<?php endif ?>
		<?php if ($_SESSION['list']+4 < $usersCount['count(*)'] / $paginationStep): ?>
			<a href="/users/list/<?= $_SESSION['list']+4 ?>"><?= $_SESSION['list']+4 ?></a>
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

	<form class="search" action="/users/list/<?= $_SESSION['list'] ?>">
		<input name="strToSearch" type="text" placeholder="Поиск">
		<button class="rounded-button"><i class="fas fa-search"></i></button>
	</form>
</div>
