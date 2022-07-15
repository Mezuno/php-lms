<?php 

return [

    "main" => [
        "filename" => "pages/main"
    ],

    "login" => [
        "filename" => "pages/login"
    ],

    "register" => [
        "filename" => "pages/register"
    ],

    "users" => [
        "filename" => "pages/users"
    ],

    "users/list/[0-9]+" => [
        "filename" => "pages/users"
    ],

    "users/[0-9]+/create" => [
        "filename" => "create"
    ],

    "users/[0-9]+" => [
        "filename" => "pages/profile"
    ],

    "users/[0-9]+/delete" => [
        "filename" => "api/delete/users/index"
    ],

    "users/[0-9]+/update" => [
        "filename" => "api/update/users/index"
    ],

    "register/action" => [
        "filename" => "includes/register-user"
    ],

];
