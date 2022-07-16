<tr>
    <td class="td-userdata"><b></b></td>
    <td class="td-userdata"><b>ID</b></td>
    <td class="td-userdata"><b>E-mail</b></td>
    <td class="td-userdata"><b>Login</b></td>
    <td class="td-userdata"><b>Role</b></td>
    <td class="td-userdata">
        <?php if (isset($_SESSION['token']) && $authUserData['id_role'] == 1): ?>
            <a href="<?= $create_user_form_link ?>" class="add-button"><i class="fa-solid fa-plus"></i></a>
            <a href="<?= $create_n_users_form_link ?>" class="add-button"><i class="fa-solid fa-plus"></i> N</a>
        <?php endif ?>
    </td>
</tr>
