<?php 

require $_SERVER['DOCUMENT_ROOT'].'/config/links.php';

?>

<!DOCTYPE html>
<html>
<head>
	<title>Project | <?= $pageName ?> </title>
    <meta charset="UTF-8">
    <?php echo '<link rel="stylesheet" href="/resources/css/style.css?v='.time().'">'; ?>
    <script src="https://kit.fontawesome.com/9982e2a196.js" crossorigin="anonymous"></script>
</head>

<body>
<header class="header">
    <div class="header__row">
        <h1 class="page-title"><a class="logo-link" href="/users"><i class="fa-solid fa-heart-crack"></i></a></h1>
        <h1 class="page-title center"><?= $pageName ?></h1>

        <div class="">
            <?php if(isset($_SESSION['user_token'])): ?>
                <a class="header__link" href="/users/<?= $authUserData['user_id'] ?>"><?= $authUserData['user_email'] ?></a>
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

<?php if(isset($_SESSION['user_token'])): ?>
<div class="navigation flex-column p20">
	<div class="mb20"><a href="/users">Юзеры</a></div>
	<div class="mb20"><a href="/courses">Мои Курсы</a></div>
</div>
<?php endif ?>