<?php

namespace Core\Account\Application\User;

use Exception;

use App\ApiResponse;
use Core\Account\Domain\AccountService;

class UserProfile
{
    static function userProfile()
    {
        try {
            return AccountService::userProfile();
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }
}
