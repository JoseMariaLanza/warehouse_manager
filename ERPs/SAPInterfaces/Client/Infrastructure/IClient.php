<?php

namespace ERPs\SAPInterfaces\Client\Infrastructure;

use Illuminate\Http\Request;

interface IClient
{
    public function get(Request $request);
    // public function parseResult($result);
}
