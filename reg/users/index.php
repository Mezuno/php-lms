<?php

session_start();
if (isset($_SESSION['token'])) header('Location: /php-app/');

$pageName = 'Register';
require $_SERVER['DOCUMENT_ROOT'].'/php-app/includes/links.php';
require $header_link;

?>

<?php if (!isset($_SESSION['token'])): ?>

<div class="p20 login">
  <div class="p20-bg-rnd-container flex-col">

    <form method="post" id="reg_form" action="<?= $reg_user_link ?>">
        <input class="login__input" value="<?= $_SESSION['savedLoginToReg'] ?>" type="text" id="login" name="login" placeholder="Логин" autocomplete="off"/><br>
        <input class="login__input" value="<?= $_SESSION['savedEmailToReg'] ?>" type="email" id="email" name="email" placeholder="Почта" autocomplete="off"/><br>
        <input class="login__input" value="<?= $_SESSION['savedPassToReg'] ?>"  type="password" id="password" name="password" placeholder="Пароль" autocomplete="off"/><br>
        <input class="login__input" value="<?= $_SESSION['savedPassRepeatToReg'] ?>"  type="password" id="passwordRepeat" name="passwordRepeat" placeholder="Повторите пароль" autocomplete="off"/><br>
        <input class="rounded-button login__button" type="submit" name="logbtn" id="logbtn" value="Зарегестрироваться">
    </form>

    <div id="message" class="red notification"><?php if (isset($_COOKIE['regError'])) echo $_COOKIE['regError']; ?></div>
    <div id="message" class="green notification"><?php if (isset($_COOKIE['regSuccess'])) echo $_COOKIE['regSuccess']; ?></div>
    
    <a href="/php-app/" class="rounded-button"><i class="fa-solid fa-arrow-left"></i> На главную</a>


    </div>
</div>
<?php endif ?>