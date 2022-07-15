<?php

require_once $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/links.php';
require_once $connect_db_link;
require $get_auth_user_data_link;
require $check_access_admin_link;

$stmt = $db->query("SELECT id FROM `users` ORDER BY `id` DESC LIMIT 1");
$row = $stmt->fetch();
$id = $row['id'];
$i = $id;

$n = $_GET['countUsersToCreate'];

while ($i <= $id+$n-1) {
    $email = 'pochta'.($i+1).'@mail.ru';
    $login = 'login'.$i+1;
    $password = 'password'.$i+1;
    $password = md5(md5($password."yalublulipton"));

    $db->query("INSERT INTO `users` (`email`,`login`, `password`) VALUES ('$email','$login', '$password')");
    $i++;
}

header('Location: /php-app/');

//'INSERT INTO `users` (`email`,`login`, `password`) VALUES ('$email','$login', '$password')'