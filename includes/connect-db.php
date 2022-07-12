<?php

	$host = 'localhost';
	$user = 'root';
	$pass = '22072003';
	$db = 'new_schema';
	// $db = mysqli_connect($server, $user, $password, $db);

	$charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $db = new PDO($dsn, $user, $pass, $opt);


	// Так сказали ненада

	// try {
	// 	$db = new PDO($dsn, $user, $pass);
	// } catch (PDOException $e) {
	// 	die('Подключение не удалось: ' . $e->getMessage());
	// }


	if($db->connect_error){
		die("Ошибка: " . $db->connect_error); 
	}