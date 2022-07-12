<?php

    session_start();
    if (isset($_SESSION['token'])) unset($_SESSION['token']);
    header('Location: /php-app/');

?>