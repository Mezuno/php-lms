<?php 


function checkLogin($login, $password, $db) {

    if (!isset($login) || empty($login)) {
        unset($_SESSION["loginLogin"]);
        $_SESSION['logError'] = 'Введите логин';
        return false;
    }

    if (!isset($password) || empty($password)) {
        $_SESSION["loginLogin"] = $login;
        $_SESSION['logError'] = 'Введите пароль';
        return false;
    }

    $login = filter_var(trim($login), FILTER_SANITIZE_STRING);
    $password = filter_var(trim($password), FILTER_SANITIZE_STRING);
    $password =  md5(md5($password.'yalublulipton'));
    
    $resultQuery = $db->query("SELECT token FROM `users` WHERE `login` = '$login' AND `password` = '$password' AND `deleted_at` IS NULL");
    $authUserData = $resultQuery->fetch();

    if (!$authUserData) {
        $_SESSION["loginLogin"] = $login;
        $_SESSION['logError'] = 'Неверный логин или пароль';
        return false;
    }

    if (!empty($authUserData['token'])) {
        $_SESSION["token"] = $authUserData['token'];
        unset($_SESSION["loginLogin"]);
        
        return true;
    }

    $token = md5(md5($password.time()));
    $db->query("UPDATE `users` SET `token` = '$token' WHERE `login` = '$login' AND `password` = '$password'");
    
    $_SESSION["token"] = $token;
    unset($_SESSION["loginLogin"]);

    return true;

}
