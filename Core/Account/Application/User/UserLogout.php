<?php

namespace Core\Account\Application\User;

use Exception;

use App\ApiResponse;
use Core\Account\Domain\AccountService;

class UserLogout
{
    static function logout()
    {
        try {
            return AccountService::logout();
        } catch (Exception $ex) {
            return response(['error' => $ex->getMessage()]);
        }
    }
}
