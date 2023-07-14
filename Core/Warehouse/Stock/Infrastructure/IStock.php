<?php

namespace Core\Warehouse\Stock\Infrastructure;

use Illuminate\Http\Request;


interface IStock
{
    public function get($par = null);

    public function store(Request $request);

    public function update(Request $request);

    public function delete();
}
