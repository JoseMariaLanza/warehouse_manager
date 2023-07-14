<?php

namespace ERPs\SAPInterfaces\Delivery\Infrastructure;

use Illuminate\Http\Request;


interface IDelivery
{
    public function get(Request $request);
}
