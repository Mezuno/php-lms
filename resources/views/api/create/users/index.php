<?php

require $_SERVER['DOCUMENT_ROOT'].'/config/links.php';
require $connect_db_link;
require_once $verify_function_link;
require_once $get_auth_user_data_link;
require_once $get_user_data_by_id_function_link;
require_once $check_access_admin_link;
require_once $create_user_link;

$pageName = 'Создание пользователя';
require_once $header_link;

?>

<div class="p20 flex-alit-center flex-just-center flex-row">

    <div class="p20-bg-rnd-container flex-col">
        <form class="create-form" action="#" method="post">
            <input type="text" value="<?= $_POST['login'] ?>" name="login" placeholder="Login" autocomplete="off" required><br>
            <input type="email" value="<?= $_POST['email'] ?>" name="email" placeholder="E-mail" autocomplete="off" required><br>
            <input type="password" name="password" placeholder="Password" autocomplete="off" required><br>
            <input type="password" name="passwordRepeat" placeholder="Password" autocomplete="off" required><br>
            <input type="number" value="<?= $_POST['role'] ?>" name="role" placeholder="Role" autocomplete="off" required><br>
            <input type="submit" name="submit" class="rounded-button" value="Добавить">
        </form>

        <?php if (isset($createSuccess)):?>
            <div class="notification">
                <?php if (!$createSuccess): ?>
                    <div class="red p8 fading">
                        <?= $errorString ?>
                    </div>
                <?php elseif($createSuccess): ?>
                    <div class="green p8 fading">
                        Пользователь <?= $login ?> успешно создан!
                    </div>
                <?php endif ?>
            </div>
        <?php endif ?>

        <a href="/users" class="rounded-button"><i class="fa-solid fa-arrow-left"></i> К списку</a>
    </div>

</div>

</body>
</html>