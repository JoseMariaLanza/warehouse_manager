<?php

namespace Core\Account\Infrastructure;

use Illuminate\Http\Request;


interface IJWTAuth
{
    static public function encode(array $data, array $attachProperties);

    static public function decode(Request $request, array $attachProperties = null);
}
