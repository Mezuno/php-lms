<?php

session_start();
if (!isset($_SESSION['token'])) {
	setcookie('error', 'Авторизуйся, чтобы ты хоть чего-то стоил на этом ресурсе', time()+1, '/php-app');
	header('Location: /login');
	die();
}

$pageName = 'Таблица пользователей';
require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.php';
require_once $pagination_link;
require_once $get_user_avatar_url_function_link;

include $cookie_error_link;

?>

<div class="navigation">
	
</div>

<?php include $pagination_html_link ?>

<table cellspacing="0px" cellpadding="10px" border-spacing="1" bordercolor="#606060">

	<?php

		include $table_header_html_link;

		if (isset($_GET['strToSearch'])) {
			$strToSearch = $_GET['strToSearch'];

			$resultQuery = $db->query("SELECT * FROM new_schema.users
			INNER JOIN new_schema.roles ON users.roleid = roles.id_role
			WHERE `deleted_at` IS NULL
			AND ((`id` LIKE '%$strToSearch%') OR (`login` LIKE '%$strToSearch%') OR (`email` LIKE '%$strToSearch%'))
			ORDER BY id DESC
			LIMIT ".(($_SESSION['list']-1)*$paginationStep).", $paginationStep");
		} else {
			$resultQuery = $db->query("SELECT * FROM new_schema.users
			INNER JOIN new_schema.roles ON users.roleid = roles.id_role
			WHERE deleted_at IS NULL
			ORDER BY id DESC
			LIMIT ".(($_SESSION['list']-1)*$paginationStep).", $paginationStep");
		}

		while ($userData = $resultQuery->fetch()) { require $table_html_link; }

	?>
	<div class="volume1"></div>
	<div class="volume2"></div>
	<div class="volume3"></div>
</table>



</body>
</html>
