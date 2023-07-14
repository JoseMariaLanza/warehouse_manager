<?php

namespace App\Http\Controllers\Api\v1\Shifts;

use App\Http\Controllers\Controller;
use Core\Shifts\Infrastructure\IShift;
use Illuminate\Http\Request;

class ShiftController extends Controller
{

    protected $shift;

    function __construct(IShift $shift)
    {
        $this->shift = $shift;
    }

    public function index(Request $request)
    {
        return $this->shift->get($request);
    }

    public function store(Request $request)
    {
        return $this->shift->store($request);
    }

    public function update(Request $request)
    {
        return $this->shift->update($request);
    }

    public function getFiltered(Request $request)
    {
        return $this->shift->getFiltered($request);
    }
}
