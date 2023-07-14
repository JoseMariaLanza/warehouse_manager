<?php

namespace ERPs\CustomerInterfaces\Orders\Infrastructure;

use Illuminate\Http\Request;


interface IOrder
{
    public function get($par = null);

    public function store(Request $request);

    public function update(Request $request);

    public function delete();
}
