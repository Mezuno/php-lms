<?php

function checkCourseOwner($id_course, $id_user, &$db) {
    
    $resultQuery = $db->query("SELECT * FROM courses
    WHERE deleted_at_course IS NULL
    AND author_course = $id_user
    AND id_course = $id_course");
    
    $authUserCourseData = $resultQuery->fetch();
    
    return $authUserCourseData;
    
}
