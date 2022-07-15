
<tr>

    <td class="td-userdata">
        <?php if($userData['avatar_path'] != NULL && file_exists($_SERVER['DOCUMENT_ROOT'].$userData['avatar_path'])): ?>
            <a href="/users/<?= $userData['id']?>">
                <img class="td-img" src="<?= $userData['avatar_path'] ?>?v=<?= time() ?>" alt="">
            </a>
        <?php else: ?>
            <a href="/users/<?= $userData['id']?>">
                <img class="td-img" src="/img/users/profile/avatar/default.jpg" alt="">
            </a>
        <?php endif ?>
    </td>

    <td class="td-userdata"><?= $userData['id'] ?></td>
    <td class="td-userdata"><?= $userData['email'] ?></td>
    <td class="td-userdata"><a href="/users/<?= $userData['id']?>"><?= $userData['login'] ?></a></td>
    <td class="td-userdata"><?= $userData['title_role'] ?></td>
    <td class="td-buttons">

    <?php if ((isset($_SESSION['token']) && $authUserData['id_role'] == 1)
    || (isset($_SESSION['token']) && $authUserData['id'] == $userData['id'])): ?>

        <a class="action-button" href="/users/<?= $userData['id'] ?>/update"><i class="fa-solid fa-pen"></i></a>

        <?php if ($authUserData['id_role'] == 1): ?>
            <a class="action-button red" href="/users/<?= $userData['id'] ?>/delete"><i class="fa-solid fa-trash"></i></a>
        <?php endif ?>

    <?php endif ?>

	</td> <!-- td-buttons end -->
</tr>
