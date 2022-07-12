<?php 

if (!isset($_POST['logbtn'])) header('Location: /php-app/');

session_start();
require_once $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/links.php';
require_once $connect_db_link;
require $isset_not_empty_check_function;


if (checkEmpty($_POST['login'])) {
    $logError = 'Введите логин';
    setcookie('logError', $logError, time()+5, '/php-app');
    header('Location: '.$auth_user_form_link);
} else {

    if (checkEmpty($_POST['password'])) {
        $logError = 'Введите пароль';
        $_SESSION["loginLogin"] = $_POST['login'];
        setcookie('logError', $logError, time()+5, '/php-app');
        header('Location: '.$auth_user_form_link);
    } else {

        $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
        $password =  md5(md5($_POST['password'].'yalublulipton'));
        // $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
        
        $resultQuery = $db->query("SELECT token FROM `users` WHERE `login` = '$login' AND `password` = '$password'");
        $authUserData = $resultQuery->fetch();
        
        
        if (!$authUserData) {
            $_SESSION["loginLogin"] = $_POST['login'];
            $_SESSION["loginPassword"] = $_POST['password'];
            $logError = 'Неверный логин или пароль';
            setcookie('logError', $logError, time()+5, '/php-app');
            header('Location: '.$auth_user_form_link);
        } else {

            if (!empty($authUserData['token'])) {
                $_SESSION["token"] = $authUserData['token'];
                unset($_SESSION["loginLogin"]);
                unset($_SESSION["loginPassword"]);
                header('Location: /php-app/');
            } else {

                $token = md5(md5($password.time()));
                $db->query("UPDATE `users` SET `token` = '$token' WHERE `login` = '$login' AND `password` = '$password'");
                
                $_SESSION["token"] = $token;
                unset($_SESSION["loginLogin"]);
                unset($_SESSION["loginPassword"]);
                header('Location: /php-app/');

            }
            

            
        }

    }    

}


 ?>