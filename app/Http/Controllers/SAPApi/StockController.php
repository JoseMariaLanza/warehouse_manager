<?php

namespace App\Http\Controllers\SAPApi;

use App\Http\Controllers\Controller;
use ERPs\SAPInterfaces\Stock\Infrastructure\IStock;
use Illuminate\Http\Request;

class StockController extends Controller
{
    protected $stock;

    public function __construct(IStock $stock)
    {
        $this->stock = $stock;
    }

    public function index(Request $request)
    {
        return $this->stock->get($request);
    }
}
