<?php 

return [

    // log reg
    "login" => [
        "filename" => "public/pages/login"
    ],

    "register" => [
        "filename" => "public/pages/register"
    ],

    "register/action" => [
        "filename" => "includes/register-user"
    ],


    // users table
    "users" => [
        "filename" => "public/pages/users"
    ],

    "users/list/[0-9]+" => [
        "filename" => "public/pages/users"
    ],

    "users/list/\-[0-9]+" => [
        "filename" => "public/pages/404"
    ],


    // users profile
    "users/[0-9]+" => [
        "filename" => "public/pages/profile"
    ],


    // users crud
    "users/create" => [
        "filename" => "api/create/users/index"
    ],

    "users/create/n" => [
        "filename" => "api/create/users/create-n-users-form"
    ],

    "users/[0-9]+/delete" => [
        "filename" => "api/delete/users/index"
    ],

    "users/[0-9]+/update" => [
        "filename" => "api/update/users/index"
    ],

];
