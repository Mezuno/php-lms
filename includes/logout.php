<?php

session_start();
if (isset($_SESSION['user_token'])) session_destroy();
header('Location: /login');
