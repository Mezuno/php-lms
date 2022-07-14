<?php

session_start();
if (isset($_SESSION['token'])) header('Location: /php-app/');

$pageName = 'Login';
require $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/header.php';

include $cookie_error_link;

?>

<?php if (!isset($_SESSION['token'])): ?>

<div class="p20 login">
  <div class="p20-bg-rnd-container flex-col">

    <form method="post" id="reg_form" action="<?= $auth_user_link ?>">
        <input class="login__input" tabindex="1" value="<?php if(isset($_SESSION['loginLogin'])) echo $_SESSION['loginLogin'] ?>"
         type="text" id="login" name="login" placeholder="Логин" /><br>
        <input class="login__input mb20"  tabindex="2" value="<?php if(isset($_SESSION['loginPassword'])) echo $_SESSION['loginPassword'] ?>"
          type="password" id="password" name="password" placeholder="Пароль" /><br>
        <input class="rounded-button mb20 login__button" tabindex="3" type="submit" name="logbtn" id="logbtn" value="Войти">
    </form>

    <?php if (isset($_COOKIE['logError'])): ?><div id="message" class="red notification"><?= $_COOKIE['logError']; ?></div><?php endif ?>

    <p class="login__if">Не зарегестрированы?&nbsp</p>
    <a tabindex="4" class="login__reglink" href="<?= $reg_user_form_link ?>">Регистрация</a>
    
    <a tabindex="5" href="/php-app/" class="rounded-button"><i class="fa-solid fa-arrow-left"></i> На главную</a>
  </div>

</div>
<?php endif ?>