<?php

function getUserDataById($id, &$db) {
    
    $sql = "SELECT * FROM new_schema.users
    INNER JOIN new_schema.roles ON users.roleid = roles.id_role
    WHERE deleted_at IS NULL AND id = ?;";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->fetch();

}

function getCourseDataById($id, &$db) {
    
    $sql = "SELECT * FROM new_schema.courses
    INNER JOIN new_schema.users ON courses.author_course = users.id
    WHERE deleted_at_course IS NULL AND id_course = ?;";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->fetch();

}
