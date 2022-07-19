<?php

session_start();
require $_SERVER['DOCUMENT_ROOT'].'/config/links.php';
require $check_auth_link;
require $connect_db_link;

if (!checkAuth()) {
	setcookie('error', 'Авторизуйся, чтобы ты хоть чего-то стоил на этом ресурсе', time()+1, '/php-app');
	header('Location: /');
	die();
} else {
	require $get_auth_user_data_link;
	$authUserId = $authUserData['id'];
}

$pageName = 'Список курсов';
require_once $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/header.php';
require_once $get_user_avatar_url_function_link;

$paginationEntity = 'courses';
require_once $pagination_link;

include $cookie_error_link;

?>

<?php include $pagination_html_link ?>

<table cellspacing="0px" cellpadding="10px" border-spacing="1" bordercolor="#606060">

	<?php

		include $table_courses_header_html_link;

		if (isset($_GET['strToSearch'])) {
			$strToSearch = $_GET['strToSearch'];

			$resultQuery = $db->query("SELECT * FROM new_schema.courses
			INNER JOIN new_schema.users ON users.id = courses.author_course
			WHERE deleted_at_course IS NULL
			AND ((`login` LIKE '%$strToSearch%') OR (`title_course` LIKE '%$strToSearch%'))
			AND author_course = $authUserId
			ORDER BY id DESC
			LIMIT ".(($_SESSION['list']-1)*$paginationStep).", $paginationStep");
		} else {

            $resultQuery = $db->query("SELECT * FROM new_schema.courses
            INNER JOIN new_schema.users ON courses.author_course = users.id
            WHERE author_course = $authUserId AND deleted_at_course IS NULL
            ORDER BY id_course DESC
			LIMIT ".(($_SESSION['list']-1)*$paginationStep).", $paginationStep");
		}

		while ($courseData = $resultQuery->fetch()) { require $table_courses_html_link; }

	?>
	<!-- <div class="volume1"></div>
	<div class="volume2"></div>
	<div class="volume3"></div> -->
</table>

</body>
</html>
