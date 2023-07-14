<?php

namespace Core\Account\Domain;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\ApiResponse;
use App\Models\User;
use Core\Account\Domain\Repositories\UserRepository;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;


class AccountService
{

    public static function getClient()
    {
        return UserRepository::loginERP();
    }

    public static function register(Request $request)
    {
        try {
            $user = UserRepository::create($request);

            return $user;
        } catch (Exception $ex) {
            return $user;
        }
    }

    public static function login(Request $request)
    {
        $user = UserRepository::login($request->email);
        if (!empty($user)) {
            if (Hash::check($request->password, $user->password)) {
                $auth_token = $user->createToken("auth_token")->plainTextToken;
                $user->auth_token = $auth_token;

                return $user;
            } else {
                return ApiResponse::badRequest('Incorrect password.');
            }
        }
        return ApiResponse::notFound('User doesn\'t exists. Create an account to proceed');
    }

    public static function userProfile()
    {
        $authUser = auth()->user();
        $user = User::where('id', $authUser->id)->with('roles')->first();
        $user->permissions = $user->getAllPermissions();

        return $user;
    }

    public static function logout()
    {
        try {
            auth()->user()->tokens()->delete();
            return ApiResponse::ok('User logged out successfuly.');
        } catch (\Throwable $th) {
            throw response([
                'error' =>  $th->getMessage()
            ]);
        }
    }
}
