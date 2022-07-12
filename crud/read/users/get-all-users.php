<?php

$sql = "SELECT * FROM new_schema.users
		INNER JOIN new_schema.roles ON users.roleid = roles.id_role
		WHERE deleted_at IS NULL
		ORDER BY roleid
		LIMIT ".(($_GET['list']-1)*$paginationStep).", ".$paginationStep."";
		
$queryResult = $db->query($sql);
