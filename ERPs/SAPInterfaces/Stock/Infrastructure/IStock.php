<?php

namespace ERPs\SAPInterfaces\Stock\Infrastructure;

use Illuminate\Http\Request;


interface IStock
{
    public function get(Request $request);
}
