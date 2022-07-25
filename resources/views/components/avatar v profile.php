
<!-- Аватар в профиле -->

<?php if($userData['user_id'] == $authUserData['user_id']): ?>
    <form id="profile__change-img-form" class="profile__change-img-form" enctype="multipart/form-data" action="/includes/upload-avatar.php" method="post">
        <input name="avatar" type="file" id="avatar__input" hidden>
        <label class="profile__img-box" for="avatar__input">

            <?php if (file_exists($_SERVER['DOCUMENT_ROOT'].getAvatarUrlById($authUserData['user_id'], $db))
            && getAvatarUrlById($authUserData['user_id'], $db) != '/resources/img/users/profile/avatar/'): ?>
            <img class="profile__img profile__img_hover" src="<?= getAvatarUrlById($authUserData['user_id'], $db) ?>?v=<?= time() ?>">
            <?php else: ?>
            <img class="profile__img profile__img_hover" src="<?= $default_avatar_link ?>?v=<?= time() ?>">
            <?php endif ?>
        </label>
    </form>
    
    <button form="profile__change-img-form" type="submit" class="change-avatar-button">Обновить &nbsp<i class="fas fa-pen-square"></i></button>

<?php else: ?>
    <div class="profile__change-img-form">
        <?php if (file_exists($_SERVER['DOCUMENT_ROOT'].getAvatarUrlById($userData['user_id'], $db))
            && getAvatarUrlById($userData['user_id'], $db) != '/resources/img/users/profile/avatar/'): ?>
            <div class="ptofile__img-box"><img class="profile__img" src="<?= getAvatarUrlById($userData['user_id'], $db) ?>?v=<?= time() ?>"></div>
        <?php else: ?>
            <div class="ptofile__img-box"><img class="profile__img" src="<?= $default_avatar_link ?>?v=<?= time() ?>" alt=""></div>
        <?php endif ?>
    </div>   
<?php endif ?>


<!-- Аватар в таблице -->

<?php if($userData['user_avatar_filename'] != NULL && file_exists($_SERVER['DOCUMENT_ROOT'].getAvatarUrlById($userData['user_id'], $db))): ?>
    <a href="/users/<?= $userData['user_id']?>">
        <img class="td-img" src="<?= getAvatarUrlById($userData['user_id'], $db) ?>?v=<?= time() ?>" alt="">
    </a>
    <?php else: ?>
    <a href="/users/<?= $userData['user_id']?>">
        <img class="td-img" src="<?= $default_avatar_link ?>" alt="">
    </a>
<?php endif ?>