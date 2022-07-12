<?php

function getUserDataById($id, $db) {
    
    $sql = "SELECT * FROM new_schema.users
    INNER JOIN new_schema.roles ON users.roleid = roles.id_role
    WHERE id = ?;";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->fetch();

}
