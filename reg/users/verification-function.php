<?php

require_once $isset_not_empty_check_function;

function verifyInputData($inputDataKey, array $inputData) {

    $errorsOfVerify = [];

    foreach ($inputData as $key => $value) {
        if ($inputDataKey == $key && $key != 'passwordRepeat')
        if (checkEmpty($value)) array_push($errorsOfVerify, $key.' не может быть пустым!<br><br>');
    }

    switch ($inputDataKey) {

        case 'login':

            if (strlen($inputData[$inputDataKey]) < 4)
                array_push($errorsOfVerify, 'Минимальная длина логина 4 символа<br><br>');

            if (strlen($inputData[$inputDataKey]) > 20)
                array_push($errorsOfVerify, 'Максимальная длина логина 20 символов<br><br>');

            if (!preg_match("/^[a-zA-Z0-9\-_]+$/", $inputData[$inputDataKey]))
                array_push($errorsOfVerify, 'В логине разрешены только латинские символы, цифры и символы - и _<br><br>');

            break;

        case 'email':
            if (!filter_var($inputData[$inputDataKey], FILTER_VALIDATE_EMAIL) !== false)
                array_push($errorsOfVerify, 'Проверьте правильность E-Mail<br><br>');

            break;

        case 'password':

             if (strlen($inputData[$inputDataKey]) < 8)
                array_push($errorsOfVerify, 'Минимальная длина пароля 8 символа<br><br>');

            if (strlen($inputData[$inputDataKey]) > 35)
                array_push($errorsOfVerify, 'Максимальная длина пароля 35 символов<br><br>');

            if (!preg_match("/^[a-zA-Z0-9\-_]+$/", $inputData[$inputDataKey]))
                array_push($errorsOfVerify, 'В пароле разрешены только латинские<br>символы, цифры и символы - и _<br><br>');

            if ($inputData['password'] != $inputData['passwordRepeat'])
                array_push($errorsOfVerify, 'Пароли не совпадают<br><br>');

            if ($inputData['password'] == $inputData['login'])
                array_push($errorsOfVerify, 'Логин и пароль не могут быть одинаковыми<br><br>');
                
            break;
    }


    return $errorsOfVerify;
}
