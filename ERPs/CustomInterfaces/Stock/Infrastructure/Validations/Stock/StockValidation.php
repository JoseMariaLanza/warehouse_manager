<?php

namespace ERPs\CustomInterfaces\Stock\Infrastructure\Validations\Stock;

use Illuminate\Http\Request;

class StockValidation
{
    public static function validateStore(Request $request)
    {
        // Esto es a modo de ejemplo, crear las validaciones correspondientes
        return $request->validate([
            'name' => 'required|name',
        ]);
    }
}
