<tr>
    <td class="td-userdata"><b></b></td>
    <td class="td-userdata"><b>ID</b></td>
    <td class="td-userdata"><b>E-mail</b></td>
    <td class="td-userdata"><b>Login</b></td>
    <td class="td-userdata"><b>Role</b></td>
    <td class="td-userdata">
        <?php if (isset($_SESSION['user_token']) && $authUserData['role_id'] == 1): ?>
            <a href="/users/create" class="add-button"><i class="fa-solid fa-plus"></i></a>
        <?php endif ?>
    </td>
</tr>
