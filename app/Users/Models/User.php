<?php

namespace app\Users\Models;

use app\Core\Database as Database;

class User
{
    private $dbConnect;

    public function __construct()
    {
        $this->dbConnect = new Database();
    }

    public function getUsers($limit, $page)
    {
        return $this->dbConnect->select("SELECT `user_id`, `user_login`, `user_email`, `user_avatar_filename`, `role_title`
                            FROM new_schema.users
                            INNER JOIN new_schema.roles ON users.user_role_id = roles.role_id
                            WHERE `user_deleted_at` IS NULL
                            ORDER BY `user_id` DESC
                            LIMIT ?, ?", [($page-1)*$limit, $limit]);
    }

    public function getUser($id)
    {
        return $this->dbConnect->select("SELECT `user_id`, `user_login`, `user_email`, `user_avatar_filename`, `role_title`
                            FROM new_schema.users
                            INNER JOIN new_schema.roles ON users.user_role_id = roles.role_id
                            WHERE `user_deleted_at` IS NULL
                            AND `user_id` = ?",
                            [$id]);
    }

    public function getUsersCount()
    {
        return $this->dbConnect->select("SELECT count(*) FROM users WHERE user_deleted_at IS NULL");   
    }

    public function deleteUser($id)
    {
        return $this->dbConnect->delete("UPDATE `users` SET `user_deleted_at` = NOW() WHERE `user_id` = ?", [$id]);
    }

    public function setToken($id, $token)
    {
        return $this->dbConnect->update("UPDATE `users` SET `user_token` = ? WHERE `user_id` = ?", [$token, $id]);
    }

    public function registerUser($login, $email, $password)
    {
        return $this->dbConnect->create("INSERT INTO `users` (`user_login`, `user_email`, `user_password`) VALUES (?, ?, ?)",
        [$login, $email, $password]);
    }

    public function updateUser($login, $email, $password, $id)
    {
        return $this->dbConnect->update("UPDATE `users` SET `user_login` = ?, `user_email` = ?, `user_password` = ? WHERE `user_id` = ?",
        [$login, $email, $password, $id]);
    }
    
    // Не реализовано
    public function createUser($params)
    {
        return $this->dbConnect->create("INSERT INTO `users` (`user_login`, `user_email`, `user_password`, `user_role_id`) VALUES (?, ?, ?, ?)", $params);
    }

    public function isExistsLogin($login) {
        return $this->dbConnect->select("SELECT `user_id` FROM new_schema.users WHERE `user_login` = ?", [$login]);
    }

    public function isExistsEmail($email) {
        return $this->dbConnect->select("SELECT `user_id` FROM new_schema.users WHERE `user_email` = ?", [$email]);
    }

    public function updateAvatarPath($id, $path) {
        return $this->dbConnect->update("UPDATE users SET `user_avatar_filename` = ? WHERE `user_id` = ?", [$path, $id]);
    }

}
