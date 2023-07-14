<?php

namespace Core\Shifts\Infrastructure;

use Illuminate\Http\Request;


interface IShift
{
    public function get(Request $request);

    public function getFiltered(Request $request);

    public function store(Request $request);

    public function update(Request $request);
}
