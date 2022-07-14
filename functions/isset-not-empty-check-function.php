<?php

function checkEmpty($value) {
    if (!isset($value) || empty($value)) return true;
    return false;
}