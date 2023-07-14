<?php

namespace Core\Account\Application\User;

use Exception;
use Illuminate\Http\Request;

use App\ApiResponse;
use Core\Account\Domain\AccountService;
use Core\Account\Infrastructure\Validations\UserRegisterValidation;

class UserRegister
{
    static function register(Request $request)
    {
        try {
            UserRegisterValidation::validateRegister($request);

            return AccountService::register($request);
        } catch (\Throwable $th) {
            throw $th;
            return ApiResponse::badRequest('Input data is wrong, please check.');
        }
    }
}
