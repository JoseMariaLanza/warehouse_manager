<?php

namespace Core\Account\Infrastructure\Validations;
use Illuminate\Http\Request;

class UserLoginValidation
{
    public static function validateLogin(Request $request)
    {
        return $request->validate([
            'email'     => 'required|email',
            'password'  => 'required'
        ]);
    }
}
