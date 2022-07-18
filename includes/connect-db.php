<?php

$databaseInfo = require $_SERVER['DOCUMENT_ROOT'].'/config/database.php';

$host = $databaseInfo['host'];
$database = $databaseInfo['database'];
$charset = $databaseInfo['charset'];

$dsn = "mysql:host=$host;dbname=$database;charset=$charset";

$db = new PDO($dsn, $databaseInfo['username'], $databaseInfo['password'], $databaseInfo['opt']);
