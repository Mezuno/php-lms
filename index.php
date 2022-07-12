<?php

$pageName = 'Главная страница';
require_once $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/header.php';
require_once $pagination_link;

include $cookie_error_link;

?>

<table cellspacing="0px" cellpadding="10px" border-spacing="1" bordercolor="#606060">

	<tr>
		<td class="td-userdata"><b>IMG</b></td>
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
	
	<?php

		include $get_all_users_link;

		while ($userData = $queryResult->fetch()) { require $table_html_link; }

	?>

</table>

<?php include $pagination_html_link ?>

</body>
</html>
