<?php

function getAvatarUrlById($id, &$db) {

    $avatarsPath = '/resources/img/users/profile/avatar/';

    $sql = "SELECT `user_avatar_filename` FROM users WHERE `user_id` = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    $userAvatarPathData = $stmt->fetch();

    return $avatarsPath.$userAvatarPathData['user_avatar_filename'];
}
