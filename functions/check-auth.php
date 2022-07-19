<?php

function checkAuth() {

    return isset($_SESSION['token']);
    
}
