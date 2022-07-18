<?php

function getAvatarUrlById($id, &$db) {

    $avatarsPath = '/resources/img/users/profile/avatar/';

    $sql = "SELECT avatar_filename FROM users WHERE id = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$id]);

    $userAvatarPathData = $stmt->fetch();

    return $avatarsPath.$userAvatarPathData['avatar_filename'];
}
