<?php

namespace App;

use Core\Account\Infrastructure\Facades\JWTAuth;

class ResponseType
{
    static function parse($response)
    {
        if (env('RETURN_JWT')) {
            return JWTAuth::encode($response);
        }
        return $response;
    }
}
