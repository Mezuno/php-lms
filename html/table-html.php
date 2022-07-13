
<tr>

    <td class="td-userdata">
        <?php if(file_exists($_SERVER['DOCUMENT_ROOT'].'/php-app/img/users/profile/avatar/'. $userData['id'] .'.jpg')): ?>
            <a href="/php-app/profile/?id=<?= $userData['id']?>">
                <img class="td-img" src="/php-app/img/users/profile/avatar/<?= $userData['id']; ?>.jpg?v=<?=time()?>" alt="">
            </a>
        <?php else: ?>
            <a href="/php-app/profile/?id=<?= $userData['id']?>">
                <img class="td-img" src="/php-app/img/users/profile/avatar/default.jpg" alt="">
            </a>
        <?php endif ?>
    </td>

    <td class="td-userdata"><?= $userData['id'] ?></td>
    <td class="td-userdata"><?= $userData['email'] ?></td>
    <td class="td-userdata"><a href="/php-app/profile/?id=<?= $userData['id']?>"><?= $userData['login'] ?></a></td>
    <td class="td-userdata"><?= $userData['title_role'] ?></td>
    <td class="td-buttons">

<?php if (isset($_SESSION['token']) && $authUserData['id_role'] == 1): ?>

    <form action="<?= $delete_user_link ?>" method="POST">
        <input type="text" name="id" value="<?= $userData['id'] ?>" hidden>
        <button class="action-button red" type="submit"><i class="fa-solid fa-trash"></i></button>
    </form>

    <form action="<?= $update_user_form_link ?>" method="POST">
        <input type="text" name="id" value="<?= $userData['id'] ?>" hidden>
        <button class="action-button" type="submit"><i class="fa-solid fa-pen"></i></button>
    </form>

<?php endif ?>

<?php if (isset($_SESSION['token'])): ?>
    <form action="<?= $read_user_link ?>" method="POST">
        <input type="text" name="id" value="<?= $userData['id'] ?>" hidden>
        <input type="text" name="email" value="<?= $userData['email'] ?>" hidden>
        <input type="text" name="login" value="<?= $userData['login'] ?>" hidden>
        <input type="text" name="token" value="<?= $userData['token'] ?>" hidden>
        <input type="text" name="password" value="<?= $userData['password'] ?>" hidden>
        <input type="text" name="hash" value="<?= $userData['hash'] ?>" hidden>
        <button class="action-button" type="submit"><i class="fa-solid fa-eye"></i></button>
    </form>
<?php endif ?>

	</td> <!-- td-buttons end -->
</tr>
