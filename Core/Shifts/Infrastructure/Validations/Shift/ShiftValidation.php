<?php

namespace Core\Shifts\Infrastructure\Validations\Shift;

use Illuminate\Http\Request;

class ShiftValidation
{
    public static function validateStore(Request $request)
    {
        // Esto es a modo de ejemplo, crear las validaciones correspondientes
        return $request->validate([
            'shift_date' => 'required',
        ]);
    }

    public static function validateUpdate(Request $request)
    {
        return $request->validate([
            'status' => 'required',
        ]);
    }
}
