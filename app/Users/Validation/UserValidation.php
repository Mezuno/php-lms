<?php

namespace app\Users\Validation;

use app\Users\Models\User as User;

class UserValidation
{
    public function __construct(
        private int $id = 0,
        private string $login = '',
        private string $email = '',
        private string $password = '',
        private string $passwordRepeat = '',
        private int $role = 0,
        private array $errorsOfVerify = [],
    )
    {
        
    }

    public function isValidLoginData()
    {
        $this->isValidLogin();
        $this->isValidPassword();

        return $this->errorsOfVerify;
    }

    public function isValidRegisterData()
    {
        $this->isValidLogin();
        $this->isValidEmail();
        $this->isValidPassword();
        $this->isPasswordsSame();
        $this->isExistsLogin();
        $this->isExistsEmail();

        return $this->errorsOfVerify;
    }

    public function isValidUpdateData()
    {
        $this->isValidLogin();
        $this->isValidEmail();
        if (!($this->password == '' && $this->passwordRepeat == '')) {
            $this->isValidPassword();
            $this->isPasswordsSame();
        }
        $this->isExistsLoginForUpdate();
        $this->isExistsEmailForUpdate();

        return $this->errorsOfVerify;
    }

    public function isValidCreateData()
    {
        $this->isValidRegisterData();
        $this->isValidRole();

        return $this->errorsOfVerify;
    }

    private function isValidPassword():void
    {
        if (strlen($this->password) < 8) {
            array_push($this->errorsOfVerify, 'Минимальная длина пароля 8 символов');
        }

        if (strlen($this->password) > 35) {
            array_push($this->errorsOfVerify, 'Максимальная длина пароля 35 символов');
        }

        if (!preg_match("/^[a-zA-Z0-9\-_]+$/", $this->password)) {
            array_push($this->errorsOfVerify, 'В пароле разрешены только латинские<br>символы, цифры и символы - и _');
        }

        if ($this->password == $this->login) {
            array_push($this->errorsOfVerify, 'Логин и пароль не могут быть одинаковыми');
        }
    }

    private function isValidLogin():void
    {
        if (strlen($this->login) < 4) {
            array_push($this->errorsOfVerify, 'Минимальная длина логина 4 символа');
        }

        if (strlen($this->login) > 20) {
            array_push($this->errorsOfVerify, 'Максимальная длина логина 20 символов');
        }

        if (!preg_match("/^[a-zA-Z0-9\-_]+$/", $this->login)) {
            array_push($this->errorsOfVerify, 'В логине разрешены только латинские символы, цифры и символы - и _');
        }

    }

    private function isValidEmail():void
    {
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL) !== false) {
            array_push($this->errorsOfVerify, 'Проверьте правильность E-Mail');
        }
    }

    private function isPasswordsSame():void
    {
        if ($this->password != $this->passwordRepeat) {
            array_push($this->errorsOfVerify, 'Пароли не совпадают');
        }
    }

    private function isValidRole():void
    {
        if (!($this->role == 1 || $this->role == 2)) {
            array_push($this->errorsOfVerify, 'Роль задана неверно');
        }
    }

    private function isExistsLogin():void
    {
        $userModel = new User();

        if ($userModel->isExistsLogin($this->login)) {
            array_push($this->errorsOfVerify, 'Пользователь с таким логином уже существует');
        }
    }

    private function isExistsEmail():void
    {
        $userModel = new User();

        if ($userModel->isExistsEmail($this->email)) {
            array_push($this->errorsOfVerify, 'Пользователь с такой почтой уже существует');
        }
    }

    private function isExistsLoginForUpdate()
    {
        $userModel = new User();

        $searchSame = $userModel->isExistsLogin($this->login);

        if ($searchSame) {
            if ($searchSame[0]['user_id'] != $this->id) {
                array_push($this->errorsOfVerify, 'Пользователь с таким логином уже существует');
            }
        }
    }

    private function isExistsEmailForUpdate()
    {
        $userModel = new User();

        $searchSame = $userModel->isExistsEmail($this->email);

        if ($searchSame) {
            if ($searchSame[0]['user_id'] != $this->id) {
                array_push($this->errorsOfVerify, 'Пользователь с такой почтой уже существует');
            }
        }
    }
}
