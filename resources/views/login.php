<?php

$pageName = 'Вход';
require_once $_SERVER['DOCUMENT_ROOT'].'/resources/views/components/header.php';

// $errors = $dataFromServer[0];

// var_dump($dataFromServer);
if (isset($dataFromServer['authErrors'])) {
  $authErrors = $dataFromServer['authErrors'];
}

if (isset($dataFromServer['inputData'])) {
  $inputData = $dataFromServer['inputData'];
}


// if (isset($_SESSION['token'])) {
//   header('Location: /users');
//   die();
// }
// if (isset($_POST['logbtn'])) {

//     if (checkLogin($_POST['login'], $_POST['password'], $db)) {
//       header('Location: /users');
//       die();
//     }

// } else {
//   unset($_SESSION['logError']);
// }

include $cookie_error_link;

?>

<?php if (!isset($_SESSION['token'])): ?>

<div class="p20 login">
  <div class="p20-bg-rnd-container flex-col">

    <form method="post" id="reg_form" action="/login">
        <input class="login__input" tabindex="1" value="<?= $inputData['login'] ?? '' ?>"
         type="text" id="login" name="login" placeholder="Логин" /><br>
        <input class="login__input mb20"  tabindex="2" value=""
          type="password" id="password" name="password" placeholder="Пароль" /><br>
        <input class="rounded-button mb20 login__button" tabindex="3" type="submit" name="submit" id="logbtn" value="Войти">
    </form>

    <?php if (isset($authErrors)):
      foreach($authErrors as $key => $value) {
      ?>

      <div id="message" class="red notification"><?= $value ?></div>

    <?php } endif ?>

    <p class="login__if">Не зарегестрированы?&nbsp</p>
    <a tabindex="4" class="login__reglink" href="<?= $reg_user_form_link ?>">Регистрация</a>
  </div>

</div>
<?php endif ?>