<?php

// ---- CONFIG -----------------------------------------------------------


// ---- INCLUDES ---------------------------------------------------------

$connect_db_link =                      $_SERVER['DOCUMENT_ROOT'].'/includes/connect-db.php';
$header_link =                          $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/header.php';
$get_auth_user_data_link =              $_SERVER['DOCUMENT_ROOT'].'/includes/get-auth-user-data.php';
$pagination_link =                      $_SERVER['DOCUMENT_ROOT'].'/includes/pagination.php';
$check_access_admin_link =              $_SERVER['DOCUMENT_ROOT'].'/includes/check-access-admin.php';
$cookie_error_link =                    $_SERVER['DOCUMENT_ROOT'].'/includes/cookie-error.php';
$logout_link =                          '/includes/logout.php';

// ---- HTML ------------------------------------------------------------

$table_header_html_link =               $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/table-header-html.php';
$table_html_link =                      $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/table-html.php';
$pagination_html_link =                 $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/pagination-html.php';
$table_courses_header_html_link =       $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/table-courses-header-html.php';
$table_courses_html_link =              $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/table-courses-html.php';

// ---- FUNCTIONS -------------------------------------------------------

$verify_function_link =                 $_SERVER['DOCUMENT_ROOT'].'/functions/verification-function.php';
$isset_not_empty_check_function =       $_SERVER['DOCUMENT_ROOT'].'/functions/isset-not-empty-check-function.php';
$get_user_data_by_id_function_link =    $_SERVER['DOCUMENT_ROOT'].'/functions/get-user-data-by-id-function.php';
$login_user_function_link =             $_SERVER['DOCUMENT_ROOT'].'/functions/login-user-function.php';
$start_route_function_link =            $_SERVER['DOCUMENT_ROOT'].'/functions/start-route-function.php';
$get_user_avatar_url_function_link =    $_SERVER['DOCUMENT_ROOT'].'/functions/get-user-avatar-url-function.php';
$check_course_owner_link =              $_SERVER['DOCUMENT_ROOT'].'/functions/check-course-owner.php';
$check_auth_link =                      $_SERVER['DOCUMENT_ROOT'].'/functions/check-auth.php';

// ---- CRUD USERS -------------------------------------------------------

// -- create
$create_user_form_link =                '/resources/views/api/create/users/';
$create_user_link =                     $_SERVER['DOCUMENT_ROOT'].'/api/create/users/index.php';
$create_n_users_form_link =             '/resources/views/api/create/users/index-n.php';
$create_n_users_link =                  $_SERVER['DOCUMENT_ROOT'].'/api/create/users/create-n-users.php';
$update_user_form_link =                '/resources/views/api/create/users/';
$update_user_link =                     $_SERVER['DOCUMENT_ROOT'].'/api/update/users/index.php';
$delete_user_link =                     $_SERVER['DOCUMENT_ROOT'].'/api/delete/users/index.php';

// -- CRUD COURSES ---------------------------------------------------------
$update_course_link =                   $_SERVER['DOCUMENT_ROOT'].'/api/update/courses/index.php';
$create_course_link =                   $_SERVER['DOCUMENT_ROOT'].'/api/create/courses/index.php';
$view_course_link =                     $_SERVER['DOCUMENT_ROOT'].'/api/view/courses/index.php';

// ---- CSS ----------------------------------------------------------------

$main_css_link =                        '/resources/css/style.css';

// ---- REGISTER and AUTHIFICATION -----------------------------------------

$reg_user_form_link =                   '/register';
$reg_user_link =                        '/register/action';
$auth_user_form_link =                  '/login';
$auth_user_link =                       '/auth/users/login-user.php';

// ---- PROFILE ------------------------------------------------------------


// OTHERS

$default_avatar_link =                  '/resources/img/users/profile/avatar/default.jpg';
$users_table_link =                     $_SERVER['DOCUMENT_ROOT'].'/resources/views/users.php';
$login_user_link =                      $_SERVER['DOCUMENT_ROOT'].'/resources/views/login.php';
