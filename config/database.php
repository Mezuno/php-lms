<?php

return [

    'host' => 'localhost',
    'username' => 'root',
    'password' => '22072003',
    'database' => 'new_schema',
    'charset' => 'utf8',
    'opt' => [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ],

];
