<?php

session_start();

if ((substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1)) != '') {
	$userId = substr(strrchr($_SERVER['REQUEST_URI'], '/'), 1);
}

$pageName = 'Профиль';
require $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/header.php';
require $get_user_data_by_id_function_link;
require $get_user_avatar_url_function_link;
require $get_auth_user_data_link;

$userData = getUserDataById($userId, $db);

if ($userData['id'] == NULL) {
    require '404.php';
    die;
}

if (!$userData) {
    setcookie('error', 'Пользователя с таким id не существует', time()+1, '/');
    header('Location: /users');
} else {
    if ($userData['id'] != $authUserData['id']) {
        if ($authUserData['id_role'] != 1) {
            setcookie('error', 'Вы можете просматривать только свой профиль', time()+1, '/');
            header('Location: /users');
        }
    }
}


include $cookie_error_link;

?>


<div class="profile bg-w80p-mt70">
    <div class="profile__row">

        <div class="profile__column">
            <?php if($userData['id'] == $authUserData['id']): ?>
                <form id="profile__change-img-form" class="profile__change-img-form" enctype="multipart/form-data" action="/includes/upload-avatar.php" method="post">
                    <input name="avatar" type="file" id="avatar__input" hidden>
					<label class="profile__img-box" for="avatar__input">

                        <?php if (file_exists($_SERVER['DOCUMENT_ROOT'].getAvatarUrlById($authUserData['id'], $db))
                        && getAvatarUrlById($authUserData['id'], $db) != '/resources/img/users/profile/avatar/'): ?>
						<img class="profile__img profile__img_hover" src="<?= getAvatarUrlById($authUserData['id'], $db) ?>?v=<?= time() ?>">
                        <?php else: ?>
						<img class="profile__img profile__img_hover" src="<?= $default_avatar_link ?>?v=<?= time() ?>">
                        <?php endif ?>
					</label>
                </form>
                
                <button form="profile__change-img-form" type="submit" class="change-avatar-button">Обновить &nbsp<i class="fas fa-pen-square"></i></button>

            <?php else: ?>
                <div class="profile__change-img-form">
                    <?php if (file_exists($_SERVER['DOCUMENT_ROOT'].getAvatarUrlById($userData['id'], $db))
                        && getAvatarUrlById($userData['id'], $db) != '/resources/img/users/profile/avatar/'): ?>
                        <div class="ptofile__img-box"><img class="profile__img" src="<?= getAvatarUrlById($userData['id'], $db) ?>?v=<?= time() ?>"></div>
                    <?php else: ?>
                        <div class="ptofile__img-box"><img class="profile__img" src="<?= $default_avatar_link ?>?v=<?= time() ?>" alt=""></div>
                    <?php endif ?>
                </div>   
            <?php endif ?>

            <a href="/users" class="rounded-button "><i class="fa-solid fa-arrow-left"></i> К списку</a>
        </div>

        <div class="profile__column">
            <p class="profile__name"><?= $userData['login'] ?> id: <?= $userData['id'] ?>

            <?php if ($authUserData['id'] == $userData['id'] || $authUserData['id_role'] == 1): ?>
            <a class="rounded-button" href="/users/<?= $userData['id'] ?>/update"><i class="fa-solid fa-pen"></i></a>

            <?php endif ?>

            <br></p>
            <p class="profile__item">Почта: <?= $userData['email'] ?><br></p>
            <p class="profile__item">Роль: <?= $userData['title_role'] ?><br></p>
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
