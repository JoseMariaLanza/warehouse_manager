<?php

namespace Core\Account\Infrastructure\Facades;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;
use Core\Account\Infrastructure\IJWTAuth;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Esto es a modo de ejemplo, pueden modificarse, eliminarse o agregarse
// use Core\Account}}\Infrastructure\Validations\JWTAuthStoreValidation;
// use Core\Account}}\Infrastructure\Validations\JWTAuthUpdateValidation;
// use Core\Account}}\Infrastructure\Validations\JWTAuthGetValidation;
// use Core\Account}}\Infrastructure\Validations\JWTAuthDeleteValidation;

class JWTAuth extends Facade implements IJWTAuth // Podés implementar otra interface aparte de esta poniendo una coma y el nombre de la interfaz
{
    protected static function getFacadeAccessor()
    {
        return 'jwtauth';
    }

    static function encode(array $data, array $attachProperties = null)
    {
        try {
            $encodedData = JWT::encode($data, config('jwt.key'), 'HS256');
            return $encodedData;
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /* Decoding the token. */
    static function decode(Request $request, array $attachProperties = null)
    {
        try {
            $decodedJwt = JWT::decode($request['jwt_token'], new Key(config('jwt.key'), 'HS256'));

            foreach ($decodedJwt as $key => $value) {
                $request[$key] = $value;
            }

            return $request;
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
