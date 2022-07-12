<?php

$pageName = 'Профиль';
require $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/header.php';
require $get_user_data_by_id_function_link;

$userData = getUserDataById($_GET['id'], $db);

?>

<div class="p20">

<div class="profile">
    <div class="profile__row">

        <div class="profile__column">
            <?php if($userData['id'] == $authUserData['id']): ?>
                <form id="profile__change-img-form" class="profile__change-img-form" enctype="multipart/form-data" action="upload-avatar.php" method="post">
                    <input name="avatar" type="file" id="avatar__input" hidden>
					<label class="profile__img-box" for="avatar__input">
						<img class="profile__img profile__img_hover" src="/php-app/img/users/profile/avatar/<?= $userData['id'] ?>.jpg?v=<?= time() ?>">
					</label>
                </form>
                
                <button form="profile__change-img-form" type="submit" class="change-avatar-button">Обновить &nbsp<i class="fas fa-pen-square"></i></button>

            <?php else: ?>
                <div class="profile__change-img-form">
                    <?php if (file_exists($_SERVER['DOCUMENT_ROOT'].'/php-app/img/users/profile/avatar/'.$userData['id'].'.jpg')): ?>
                        <img class="profile__img" src="/php-app/img/users/profile/avatar/<?= $userData['id'] ?>.jpg"> 
                    <?php else: ?>
                        <img class="profile__img" src="/php-app/img/users/profile/avatar/default.jpg" alt="">
                    <?php endif ?>
                </div>   
            <?php endif ?>

            <a href="/php-app/" class="rounded-button "><i class="fa-solid fa-arrow-left"></i> На главную</a>
        </div>

        <div class="profile__column">
            <p class="profile__name"><?= $userData['login'] ?>
             id<?= $userData['id'] ?><br></p>
            <p class="profile__item">email: <?= $userData['email'] ?><br></p>
            <p class="profile__item">role: <?= $userData['title_role'] ?><br></p>
        </div>        

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
