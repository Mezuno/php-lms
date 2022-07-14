
<tr>

    <td class="td-userdata">
        <?php if($userData['avatar_path'] != NULL): ?>
            <a href="/php-app/profile/?id=<?= $userData['id']?>">
                <img class="td-img" src="<?= $userData['avatar_path'] ?>?v=<?= time() ?>" alt="">
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

<?php if ((isset($_SESSION['token']) && $authUserData['id_role'] == 1)
|| (isset($_SESSION['token']) && $authUserData['id'] == $userData['id'])): ?>

    <form action="<?= $update_user_form_link ?>" method="POST">
        <input type="text" name="id" value="<?= $userData['id'] ?>" hidden>
        <button class="action-button" type="submit"><i class="fa-solid fa-pen"></i></button>
    </form>

    <?php if ($authUserData['id_role'] == 1): ?>
    <form action="<?= $delete_user_link ?>" method="POST">
        <input type="text" name="id" value="<?= $userData['id'] ?>" hidden>
        <button class="action-button red" type="submit"><i class="fa-solid fa-trash"></i></button>
    </form>
    <?php endif ?>

<?php endif ?>

	</td> <!-- td-buttons end -->
</tr>
