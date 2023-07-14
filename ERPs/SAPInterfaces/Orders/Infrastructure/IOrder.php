<?php

namespace ERPs\SAPInterfaces\Orders\Infrastructure;

use Illuminate\Http\Request;


interface IOrder
{
    public function get(Request $request);
    public function post(Request $request);
}
