<?php

session_start();
$pageName = 'Login';

require_once $_SERVER['DOCUMENT_ROOT'].'/includes/header.php';
require_once $login_user_function_link;


if (isset($_SESSION['token'])) {
  header('Location: /users');
  die();
}
if (isset($_POST['logbtn'])) {

    if (checkLogin($_POST['login'], $_POST['password'], $db)) {
      header('Location: /users');
      die();
    }

} else {
  unset($_SESSION['logError']);
}

include $cookie_error_link;

?>

<?php if (!isset($_SESSION['token'])): ?>

<div class="p20 login">
  <div class="p20-bg-rnd-container flex-col">

    <form method="post" id="reg_form" action="#">
        <input class="login__input" tabindex="1" value="<?php if(isset($_SESSION['loginLogin'])) echo $_SESSION['loginLogin'] ?>"
         type="text" id="login" name="login" placeholder="Логин" /><br>
        <input class="login__input mb20"  tabindex="2" value="<?php if(isset($_SESSION['loginPassword'])) echo $_SESSION['loginPassword'] ?>"
          type="password" id="password" name="password" placeholder="Пароль" /><br>
        <input class="rounded-button mb20 login__button" tabindex="3" type="submit" name="logbtn" id="logbtn" value="Войти">
    </form>

    <?php if (isset($_SESSION['logError'])): ?><div id="message" class="red notification"><?= $_SESSION['logError'] ?></div><?php endif ?>

    <p class="login__if">Не зарегестрированы?&nbsp</p>
    <a tabindex="4" class="login__reglink" href="<?= $reg_user_form_link ?>">Регистрация</a>
  </div>

</div>
<?php endif ?>