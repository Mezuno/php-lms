<?php

	$host = 'localhost';
	$user = 'root';
	$pass = '22072003';
	$db = 'new_schema';

	$charset = 'utf8';

    $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
    $opt = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    $db = new PDO($dsn, $user, $pass, $opt);
	