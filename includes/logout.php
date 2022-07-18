<?php

session_start();
if (isset($_SESSION['token'])) session_destroy();
header('Location: /login');
