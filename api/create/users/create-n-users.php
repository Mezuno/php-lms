<?php

if (isset($_POST['submit'])) {
	
	$stmt = $db->query("SELECT id FROM `users` ORDER BY `id` DESC LIMIT 1");
	$row = $stmt->fetch();
	$id = $row['id'];
	$i = $id;
	
	$n = $_POST['countUsersToCreate'];
	
	while ($i <= $id+$n-1) {
		$email = 'pochta'.($i+1).'@mail.ru';
		$login = 'login'.$i+1;
		$password = 'password'.$i+1;
		$password = md5(md5($password."yalublulipton"));
	
		$db->query("INSERT INTO `users` (`email`,`login`, `password`) VALUES ('$email','$login', '$password')");
		$i++;
	}
	
	header('Location: /users');
	die();
}
