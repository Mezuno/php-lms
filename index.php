<?php


require $_SERVER['DOCUMENT_ROOT'].'/config/links.php';
require $check_auth_link;

session_start();

if (checkAuth()) {
    include $users_table_link;
} else {
    include $login_user_link;
}
