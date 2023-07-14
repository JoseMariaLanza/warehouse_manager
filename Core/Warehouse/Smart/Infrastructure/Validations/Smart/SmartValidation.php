<?php

namespace Core\Warehouse\Smart\Infrastructure\Validations\Smart;

use Illuminate\Http\Request;

class SmartValidation
{
    public static function validateStore(Request $request)
    {
        // Esto es a modo de ejemplo, crear las validaciones correspondientes
        return $request->validate([
            'name' => 'required|name',
        ]);
    }
}
