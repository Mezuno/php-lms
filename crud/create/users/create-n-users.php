<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/links.php';
require_once $connect_db_link;
require $check_access_admin_link;

$stmt = $db->query("SELECT id FROM `users` ORDER BY `id` DESC LIMIT 1");
$row = $stmt->fetch();
$id = $row['id'];
$i = $id;

$n = $_GET['countUsersToCreate'];

while ($i <= $id+$n) {
    $email = 'pochta'.$i.'@mail.ru';
    $login = 'login'.$i;
    $password = 'password'.$i;
    $password = md5(md5($password."yalublulipton"));

    $db->query("INSERT INTO `users` (`email`,`login`, `password`) VALUES ('$email','$login', '$password')");
    $i++;
}

header('Location: /php-app/');

//'INSERT INTO `users` (`email`,`login`, `password`) VALUES ('$email','$login', '$password')'