<?php

namespace App\Core\Helpers;

use App\Users\Models\User as User;

class Pagination
{
    public static function runPagination($usersCount)
    {
        parse_str($_SERVER['QUERY_STRING'], $arrQueryStringParams);
        $paginationParams = self::getPaginationParams($arrQueryStringParams['limit'] ?? 10, $arrQueryStringParams['page'] ?? 1, $usersCount);
        if ($paginationParams['redirect']) {
            header('Location: /users?limit=' . $paginationParams['limit'] . '&page=' . $paginationParams['page']);
            die;
        } else {
            return $paginationParams;
        }
    }

    private static function getPaginationParams($inputLimit = 10, $inputPage = 1, $usersCount = [])
    {
        $redirect = false;
        $inputLimit = abs((int)$inputLimit);
        $inputPage = abs((int)$inputPage);

        if (isset($inputLimit) && is_numeric($inputLimit)) {
            $validLimit = (int)$inputLimit;
        } else {
            $validLimit = 10;
        }
        
        if (isset($inputPage) && is_numeric($inputPage)) {
        
            if ($inputPage < 1) {
                $validPage = 1;
                $redirect = true;
            }
        
            if ($inputPage > ceil($usersCount[0]['count(*)'] / $validLimit)) {
                $validPage = ceil($usersCount[0]['count(*)'] / $validLimit);
                $redirect = true;
            } else {
                $validPage = (int)$inputPage;
            }
        } else {
            $validPage = 1;
        }

        $arrParams = [
            'limit' => $validLimit,
            'page' => $validPage,
            'redirect' => $redirect,
        ];

        return $arrParams;
    }    
}
