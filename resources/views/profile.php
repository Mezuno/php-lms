<?php

$userData = $dataFromServer['userData'][0] ?? [];
$authUserData = $dataFromServer['authUserData'][0] ?? [];

$pageName = 'Профиль';
require $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/header.php';

include $cookie_error_link;
?>


<div class="profile bg-w80p-mt70">
    <div class="profile__row">

        <div class="profile__column">
            <?php if($userData['user_id'] == $authUserData['user_id']): ?>
                <form id="profile__change-img-form" class="profile__change-img-form" enctype="multipart/form-data" action="" method="post">
                    <input name="avatar" type="file" id="avatar__input" hidden>
                    <label class="profile__img-box" for="avatar__input">

                        <?php if (file_exists($_SERVER['DOCUMENT_ROOT'].$authUserData['user_avatar_filename'])
                        && $authUserData['user_avatar_filename'] != NULL
                        && $authUserData['user_avatar_filename'] != '/resources/img/users/profile/avatar/'): ?>
                        <img class="profile__img profile__img_hover" src="<?= $authUserData['user_avatar_filename'] ?>?v=<?= time() ?>">
                        <?php else: ?>
                        <img class="profile__img profile__img_hover" src="<?= $default_avatar_link ?>?v=<?= time() ?>">
                        <?php endif ?>
                    </label>
                </form>
            
                <button form="profile__change-img-form" type="submit" class="change-avatar-button">Обновить &nbsp<i class="fas fa-pen-square"></i></button>

            <?php else: ?>
                <div class="profile__change-img-form">
                    <?php if (file_exists($_SERVER['DOCUMENT_ROOT'].$userData['user_avatar_filename'])
                        && $userData['user_avatar_filename'] != NULL
                        && $userData['user_avatar_filename'] != '/resources/img/users/profile/avatar/'): ?>
                        <div class="ptofile__img-box"><img class="profile__img" src="<?= $userData['user_avatar_filename'] ?>?v=<?= time() ?>"></div>
                    <?php else: ?>
                        <div class="ptofile__img-box"><img class="profile__img" src="<?= $default_avatar_link ?>?v=<?= time() ?>" alt=""></div>
                    <?php endif ?>
                </div>   
            <?php endif ?>

            <a href="/users" class="rounded-button "><i class="fa-solid fa-arrow-left"></i> К списку</a>
        </div>

        <div class="profile__column">
            <p class="profile__name"><?= $userData['user_login'] ?> id: <?= $userData['user_id'] ?>

            <?php if ($authUserData['user_id'] == $userData['user_id'] || $authUserData['role_id'] == 1): ?>
            <a class="rounded-button" href="/users/<?= $userData['user_id'] ?>/update"><i class="fa-solid fa-pen"></i></a>

            <?php endif ?>

            <br></p>
            <p class="profile__item">Почта: <?= $userData['user_email'] ?><br></p>
            <p class="profile__item">Роль: <?= $userData['role_title'] ?><br></p>
        </div>        

    </div>
</div>



<script>
    let fields = document.querySelectorAll('#avatar__input');
    Array.prototype.forEach.call(fields, function (input) {

    input.addEventListener('change', function (e) {
        let countFiles = '';
        if (this.files && this.files.length >= 1){
        countFiles = this.files.length;
        }

        if (countFiles) {
        document.querySelector('.change-avatar-button').style.cssText = 'display:block';
        }
    });
    });
</script>

</body>
</html>
