<?php

$pageName = 'Регистрация';
require $_SERVER['DOCUMENT_ROOT'].'/config/links.php';
require $header_link;

if (isset($dataFromServer['regErrors'])) {
  $regErrors = $dataFromServer['regErrors'];
}

if (isset($dataFromServer['regSuccess'])) {
  $regSuccess = $dataFromServer['regSuccess'];
}

if (isset($dataFromServer['inputData'])) {
  $inputData = $dataFromServer['inputData'];
}

?>


<div class="p20 login">
  <div class="p20-bg-rnd-container flex-col">

    <form method="post" id="reg_form" action="/register">
        <input class="login__input" value="<?= $inputData['login'] ?? '' ?>" type="text" id="login" name="login" placeholder="Логин" autocomplete="off"/><br>
        <input class="login__input" value="<?= $inputData['email'] ?? '' ?>" type="email" id="email" name="email" placeholder="Почта" autocomplete="off"/><br>
        <input class="login__input" type="password" id="password" name="password" placeholder="Пароль" autocomplete="off"/><br>
        <input class="login__input mb20" type="password" id="passwordRepeat" name="passwordRepeat" placeholder="Повторите пароль" autocomplete="off"/><br>
        <input class="rounded-button mb20 login__button" type="submit" name="submit" value="Зарегестрироваться">
    </form>

    <?php if (isset($regErrors)): foreach ($regErrors as $key => $value) { ?><div id="message" class="red mb20 notification"><?= $value ?></div><?php } endif ?>
    <?php if (isset($regSuccess)): ?><div id="message" class="green mb20 notification"><?= $regSuccess ?></div><?php endif ?>
    
    <p class="login__if">Зареган?&nbsp</p>
    <a tabindex="4" class="login__reglink" href="<?= $auth_user_form_link ?>">Входи</a>


    </div>
</div>