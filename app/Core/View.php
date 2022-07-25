<?php

namespace App\Core;

class View
{

    public static function render(string $filename, array $dataFromServer = [])
    {
        $fullPath = $_SERVER['DOCUMENT_ROOT'].'/resources/views/' . $filename . '.php';

        if (!file_exists($fullPath)) {
            echo('view cannot be found');
            die;
        }

        include($fullPath);

        die;
    }

}