<?php

$userData = $dataFromServer['userData'][0];
$authUserData = $dataFromServer['authUserData'][0];


$pageName = 'Профиль';
require $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/header.php';
require $get_user_avatar_url_function_link;

include $cookie_error_link;
?>


<div class="profile bg-w80p-mt70">
    <div class="profile__row">

        <div class="profile__column">


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
