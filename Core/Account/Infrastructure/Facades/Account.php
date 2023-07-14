<?php

namespace Core\Account\Infrastructure\Facades;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

use App\ApiResponse;
use App\ResponseType;
use Core\Account\Infrastructure\IAccount;
use Core\Account\Application\User\UserRegister;
use Core\Account\Application\User\UserLogin;
use Core\Account\Application\User\UserProfile;
use Core\Account\Application\User\UserLogout;

class Account extends Facade implements IAccount
{
    protected static function getFacadeAccessor()
    {
        return 'account';
    }

    private $responseType;

    public function __construct(ResponseType $responseType)
    {
        $this->responseType = $responseType;
    }

    function register(Request $request)
    {
        try {
            $response = UserRegister::register($request);

            $data = $this->responseType->parse($response->toArray());

            return ApiResponse::ok('User created successfuly.', 'data', $data);
        } catch (Exception $ex) {
            return ApiResponse::badRequest($ex->getMessage());
        }
    }

    function login(Request $request)
    {
        try {
            $response = UserLogin::login($request);

            if (get_class($response) === 'Illuminate\Http\Response') {
                return $response;
            }

            $data = $this->responseType->parse($response->toArray());

            return ApiResponse::ok('User logged in successfuly.', 'data', $data);
        } catch (Exception $ex) {
            return ApiResponse::unauthorized($ex->getMessage());
        }
    }

    function userProfile()
    {
        try {
            $response = UserProfile::userProfile();

            $data = $this->responseType->parse($response->toArray());
            return ApiResponse::ok('User profile.', 'data', $data);
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }

    function logout()
    {
        try {
            return UserLogout::logout();
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }
}
