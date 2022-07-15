<?php

// ---- INCLUDES ---------------------------------------------------------

$header_link =                          $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/header.php';
$connect_db_link =                      $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/connect-db.php';
$get_auth_user_data_link =              $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/get-auth-user-data.php';
$pagination_link =                      $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/pagination.php';
$check_access_admin_link =              $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/check-access-admin.php';
$cookie_error_link =                    $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/cookie-error.php';
$logout_link =                          '/php-app/includes/logout.php';

// ---- HTML ------------------------------------------------------------

$table_header_html_link =               $_SERVER['DOCUMENT_ROOT'].'/php-app/html/table-header-html.php';
$table_html_link =                      $_SERVER['DOCUMENT_ROOT'].'/php-app/html/table-html.php';
$pagination_html_link =                 $_SERVER['DOCUMENT_ROOT'].'/php-app/html/pagination-html.php';

// ---- FUNCTIONS -------------------------------------------------------

$verify_function_link =                 $_SERVER['DOCUMENT_ROOT'].'/php-app/functions/verification-function.php';
$isset_not_empty_check_function =       $_SERVER['DOCUMENT_ROOT'].'/php-app/functions/isset-not-empty-check-function.php';
$get_user_data_by_id_function_link =    $_SERVER['DOCUMENT_ROOT'].'/php-app/functions/get-user-data-by-id-function.php';
$login_user_function_link =             $_SERVER['DOCUMENT_ROOT'].'/php-app/functions/login-user-function.php';
$start_route_function_link =            $_SERVER['DOCUMENT_ROOT'].'/php-app/functions/start-route-function.php';

// ---- CRUD -------------------------------------------------------------

// -- create
$create_user_form_link =                '/php-app/crud/create/users/';
$create_user_link =                     '/php-app/crud/create/users/create-user.php';

$create_n_users_link =                  '/php-app/crud/create/users/create-n-users.php';
$create_n_users_form_link =             '/php-app/crud/create/users/create-n-users-form.php';

// -- update
$update_user_form_link =                '/php-app/api/users/update';

// -- read
$read_user_link =                       '/php-app/crud/read/users/';


// -- delete
$delete_user_link =                     '/php-app/crud/delete/users/';

// ---- END CRUD


// ---- CSS ----------------------------------------------------------------

$main_css_link =                        '/php-app/css/style.css';

// ---- REGISTER and AUTHIFICATION -----------------------------------------

$reg_user_form_link =                   '/php-app/register';
$reg_user_link =                        '/php-app/reg/users/register-user.php';
$auth_user_form_link =                  '/php-app/login';
$auth_user_link =                       '/php-app/auth/users/login-user.php';

// ---- PROFILE ------------------------------------------------------------

$profile_user_link =                    '/php-app/profile/user/';
