<?php

namespace Core\Account\Infrastructure\Validations;

use Illuminate\Http\Request;

class UserRegisterValidation
{
    public static function validateRegister(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ]);
    }
}
