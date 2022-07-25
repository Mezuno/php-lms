<?php

namespace App\Users\Models;

use App\Core\Database as Database;

class Authorization
{
    private $dbConnnect;

    public function __construct()
    {
        $this->dbConnnect = new Database();
    }

    public function checkAdmin()
    {
        return $this->dbConnnect->select("SELECT `user_id`, `user_role_id`
                                        FROM new_schema.users
                                        WHERE `user_role_id` = 1
                                        AND `user_token` = ?",
                                        [$_SESSION['user_token']]);
    }

    public function checkAuth()
    {
        return isset($_SESSION['user_token']);
    }

    public function getAuthUser()
    {
        return $this->dbConnnect->select("SELECT * FROM new_schema.users
                              INNER JOIN new_schema.roles
                              ON users.user_role_id = roles.role_id
                              WHERE `user_token` = ?",
                              [$_SESSION['user_token']]);
    }

    public function authUser(string $login, string $password)
    {
        return $this->dbConnnect->select("SELECT `user_token`, `user_id` 
                              FROM new_schema.users
                              WHERE `user_login` = ?
                              AND `user_password` = ?",
                              [$login, $password]);
    }

    public function redirectToLogin() {
        header('Location: /login');
        die;
    }

    public function redirectToUsers() {
        header('Location: /users');
        die;
    }
}
