<?php

session_start();
if (!isset($_SESSION['token'])) {
	setcookie('error', 'Авторизуйся, чтобы ты хоть чего-то стоил на этом ресурсе', time()+1, '/php-app');
	header('Location: /login');
	die();
}

$pageName = 'Главная страница';
require_once $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/header.php';
require_once $pagination_link;

include $cookie_error_link;

?>

<table cellspacing="0px" cellpadding="10px" border-spacing="1" bordercolor="#606060">

	<?php

		include $table_header_html_link;

		$resultQuery = $db->query("SELECT * FROM new_schema.users
		INNER JOIN new_schema.roles ON users.roleid = roles.id_role
		WHERE deleted_at IS NULL
		ORDER BY id DESC
		LIMIT ".(($_GET['list']-1)*$paginationStep).", $paginationStep");

		while ($userData = $resultQuery->fetch()) { require $table_html_link; }

	?>

</table>

<?php include $pagination_html_link ?>

</body>
</html>
