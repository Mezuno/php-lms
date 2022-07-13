<?php

$pageName = 'Главная страница';
require_once $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/header.php';
require_once $pagination_link;

include $cookie_error_link;

?>

<table cellspacing="0px" cellpadding="10px" border-spacing="1" bordercolor="#606060">

	<?php

		include $table_header_html_link;

		include $get_all_users_link;

		while ($userData = $queryResult->fetch()) { require $table_html_link; }

	?>

</table>

<?php include $pagination_html_link ?>

</body>
</html>
