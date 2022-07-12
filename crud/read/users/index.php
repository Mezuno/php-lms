<?php
	$pageName = 'Страница пользователя id'.$_POST['id'];
	require $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/header.php';
?>


<div class="p20">
email: <?= $_POST['email'] ?><br>
login: <?= $_POST['login'] ?><br>
token: <?= $_POST['token'] ?><br>
password: <?= $_POST['password'] ?><br>
hash: <?= $_POST['hash'] ?><br>
</div>

<a href="/php-app/" class="rounded-button"><i class="fa-solid fa-arrow-left"></i> На главную</a>


</body>
</html>