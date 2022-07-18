<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/links.php';
require $connect_db_link;
require $get_auth_user_data_link;


?>

<!DOCTYPE html>
<html>
<head>
	<title>Project | <?= $pageName ?> </title>
    <meta charset="UTF-8">
    <?php echo '<link rel="stylesheet" href="'.$main_css_link.'?v='.time().'">'; ?>
    <script src="https://kit.fontawesome.com/9982e2a196.js" crossorigin="anonymous"></script>
</head>

<body>
<header class="header">
    <div class="header__row">
        <h1 class="page-title"><a class="logo-link" href="/users"><i class="fa-solid fa-heart-crack"></i></a></h1>
        <h1 class="page-title center"><?= $pageName ?></h1>

        <div class="">
            <?php if(isset($_SESSION['token'])): ?>
                <a class="header__link" href="/users/<?= $authUserData['id'] ?>"><?= $authUserData['email'] ?></a>
                <a class="header__link" href="<?= $logout_link ?>">Выйти <i class="fa-solid fa-arrow-right-from-bracket"></i></a>
            <?php else: ?>
                <a class="header__link" href="<?= $auth_user_form_link ?>">Вход</a>
                <a class="header__link" href="<?= $reg_user_form_link ?>">Регестрация</a>
            <?php endif ?>
        </div>
    </div>
</header>
<div class="bubble1"></div>
<div class="bubble2"></div>
<div class="bubble3"></div>