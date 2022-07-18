<?php


require $_SERVER['DOCUMENT_ROOT'].'/config/links.php';

session_start();

if (isset($_SESSION['token'])) {
    include $users_table_link;
} else {
    include $login_user_link;
}
