<?php

$authUserData = $dataFromServer['authUserData'];
$inputData = $dataFromServer['inputData'] ?? [];
$createErrors = $dataFromServer['createErrors'] ?? [];
$createSuccess = $dataFromServer['createSuccess'] ?? [];

$pageName = 'Создание пользователя';
require $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/header.php';

?>

<div class="p20 flex-alit-center flex-just-center flex-row">

    <div class="p20-bg-rnd-container flex-col">
        <form class="create-form" action="#" method="post">
            <input type="text" value="<?= $inputData['login'] ?? '' ?>" name="login" placeholder="Login" autocomplete="off"><br>
            <input type="email" value="<?= $inputData['email'] ?? '' ?>" name="email" placeholder="E-mail" autocomplete="off"><br>
            <input type="password" name="password" placeholder="Password" autocomplete="off"><br>
            <input type="password" name="passwordRepeat" placeholder="Password" autocomplete="off"><br>
            <input type="number" value="<?= $inputData['role'] ?? '' ?>" name="role" placeholder="Role" autocomplete="off"><br>
            <input type="submit" name="submit" class="rounded-button" value="Добавить">
        </form>

        <?php if (!empty($createErrors) || $createSuccess):?>
            <div class="notification">
                <?php if (!$createSuccess): foreach ($createErrors as $key => $value) {?>
                    <div class="red p8 fading">
                        <?= $value ?>
                    </div>
                <?php } elseif($createSuccess): ?>
                    <div class="green p8 fading">
                        Пользователь <?= $inputData['login'] ?> успешно создан!
                    </div>
                <?php endif ?>
            </div>
        <?php endif ?>

        <a href="/users" class="rounded-button"><i class="fa-solid fa-arrow-left"></i> К списку</a>
    </div>

</div>

</body>
</html>