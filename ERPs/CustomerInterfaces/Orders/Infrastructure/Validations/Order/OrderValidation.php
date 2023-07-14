<?php

namespace ERPs\CustomerInterfaces\Orders\Infrastructure\Validations\Order;

use Illuminate\Http\Request;

class OrderValidation
{
    public static function validateStore(Request $request)
    {
        // Esto es a modo de ejemplo, crear las validaciones correspondientes
        return $request->validate([
            'name' => 'required|name',
        ]);
    }
}
