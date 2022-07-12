<?php

session_start();

if (isset($_SESSION['token'])) {
    $token = $_SESSION['token'];

    $stmt = $db->prepare('SELECT * FROM users
    INNER JOIN new_schema.roles ON users.roleid = roles.id_role
    WHERE token = ?');
    $stmt->execute([$token]);

    $authUserData = $stmt->fetch();

}
