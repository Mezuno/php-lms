<?php

namespace App\Core\Traits;

trait ValidData
{
    public function isValidInt($intData) {
        return (!empty($intData) && is_numeric($intData) && is_int($intData));
    }

}
