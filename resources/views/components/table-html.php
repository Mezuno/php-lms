
<tr>
    <td class="td-userdata">
        <?php if($userData['avatar_filename'] != NULL && file_exists($_SERVER['DOCUMENT_ROOT'].getAvatarUrlById($userData['id'], $db))): ?>
            <a href="/users/<?= $userData['id']?>">
                <img class="td-img" src="<?= getAvatarUrlById($userData['id'], $db) ?>?v=<?= time() ?>" alt="">
            </a>
        <?php else: ?>
            <a href="/users/<?= $userData['id']?>">
                <img class="td-img" src="<?= $default_avatar_link ?>" alt="">
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
            <a class="action-button red" onclick="document.getElementById('delete-modal-<?= $userData['id'] ?>').style.display = 'flex'"><i class="fa-solid fa-trash"></i></a>
        <?php endif ?>

    <?php endif ?>

	</td> <!-- td-buttons end -->
</tr>

<div class="delete-modal" id="delete-modal-<?= $userData['id'] ?>">
    <p class="delete-modal-text mb20 mr20">Вы действительно хотите удалить пользователя id<?= $userData['id'] ?>?</p>
    <div class="flex-row">
        <a href="/users/<?= $userData['id'] ?>/delete" class="action-button mt20">Да</a>
        <a onclick="document.getElementById('delete-modal-<?= $userData['id'] ?>').style.display = 'none'" class="action-button ml20 mt20">Нет</a>
    </div>
</div>
