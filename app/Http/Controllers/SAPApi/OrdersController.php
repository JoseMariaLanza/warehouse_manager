<?php

namespace App\Http\Controllers\SAPApi;

use App\Http\Controllers\Controller;
use ERPs\SAPInterfaces\Orders\Infrastructure\IOrder;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    protected $order;

    public function __construct(IOrder $order)
    {
        $this->order = $order;
    }

    public function index(Request $request)
    {
        return $this->order->get($request);
    }
}
