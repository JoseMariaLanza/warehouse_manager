<?php

namespace Core\Warehouse\Smart\Infrastructure;

use Illuminate\Http\Request;


interface ISmart
{
    public function get($par = null);

    public function store(Request $request);

    public function update(Request $request);

    public function delete();
}
