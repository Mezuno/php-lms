<?php

    require_once $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/links.php';
    require_once $connect_db_link;
    require_once $verify_function_link;

    $login = filter_var(trim($_POST['login']), FILTER_SANITIZE_STRING);
    $email = filter_var(trim($_POST['email']), FILTER_SANITIZE_STRING);
    $password = filter_var(trim($_POST['password']), FILTER_SANITIZE_STRING);
    $passwordRepeat = filter_var(trim($_POST['passwordRepeat']), FILTER_SANITIZE_STRING);

    $inputData = [
        'login' => $login, 
        'email' => $email, 
        'password' => $password, 
        'passwordRepeat' => $passwordRepeat, 
    ];

    // Переделать по ПДО и EXISTS
    // $sql = "DELETE FROM users WHERE id=?";
    // $stmt= $db->prepare($sql);
    // $stmt->execute([$id]);

    $logResult = $db->query("SELECT 'id' FROM `users` WHERE `login` = '$login' OR `email` = '$email'");

    while( $row = $logResult->fetch() )
        if ($row['id'])
            $errorString = $errorString.'Пользователь с таким логином или Email уже существует<br>';
    
         
    foreach ($inputData as $key => $value) {
        $errorsArray = verifyInputData($key, $inputData);
        foreach ($errorsArray as $err) $errorString = $errorString.$err;
    }

    if ($errorString != '') {
        session_start();
        $_SESSION['savedLoginToReg'] = $login;
        $_SESSION['savedEmailToReg'] = $email;
        $_SESSION['savedPassToReg'] = $passsword;
        $_SESSION['savedPassRepeatToReg'] = $passswordRepeat;
        setcookie('regError', $errorString, time()+5, '/php-app');
        header('Location: '.$reg_user_form_link);
    } else {
        session_start();
        $_SESSION['savedLoginToReg'] = '';
        $_SESSION['savedEmailToReg'] = '';
        $_SESSION['savedPassToReg'] = '';
        $_SESSION['savedPassRepeatToReg'] = '';

        $hash = md5(md5($login . time() . 'morzhikiikorzhiki'));
        $pass = md5(md5($password."yalublulipton"));

        $db->query("INSERT INTO `users` (`login`, `email`, `password`, `hash`, `email_confirmed`) VALUES ('" . $login . "','" . $email . "','" . $pass . "', '" . $hash . "', 0)");
        
        setcookie('regSuccess', 'Вы успешно зарегестрировались!', time()+5, '/php-app');
        header('Location: '.$reg_user_form_link);
    }

// Почта (доделать)

// $headers  = "MIME-Version: 1.0\r\n";
// $headers .= "Content-type: text/html; charset=utf-8\r\n";
// $headers .= "To: <$email>\r\n";
// $headers .= "From: <>\r\n";
// $message = '
//         <html>
//         <head>
//         <title>Подтвердите Email</title>
//         </head>
//         <body>
//         <p>Что бы подтвердить Email, перейдите по <a href="что-то.php?hash=' . $hash . '">ссылке</a></p>
//         </body>
//         </html>
//         ';
// if (mail($email, "Подтвердите Email", $message, $headers)) {
//     $mess = 'Письмо со ссылкой подверждения отправлено на вашу почту, если вы не можете найти его - попробуйте проверить папку спам';
// } else {
//     $mess = 'Не удалось отправить письмо со ссылкой для подверждения :(';
// }