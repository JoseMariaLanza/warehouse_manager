<?php

namespace Core\Account\Application\User;

use Exception;
use Illuminate\Http\Request;

use App\ApiResponse;
use Core\Account\Domain\AccountService;
use Core\Account\Infrastructure\Validations\UserLoginValidation;

class UserLogin
{
    static function login(Request $request)
    {
        try {
            if (!UserLoginValidation::validateLogin($request)) {
                return ApiResponse::badRequest('Incorrect email format.');
            }

            return AccountService::login($request);
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
