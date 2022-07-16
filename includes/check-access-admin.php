<?php

if ($authUserData['id_role'] != 1) {
    setcookie('error', 'У вас нету доступа.', time()+5, '/php-app');
    header('Location: /php-app/');
    die;
}
