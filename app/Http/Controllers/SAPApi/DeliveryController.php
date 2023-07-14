<?php

namespace App\Http\Controllers\SAPApi;

use App\Http\Controllers\Controller;
use ERPs\SAPInterfaces\Delivery\Infrastructure\IDelivery;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    protected $delivery;

    public function __construct(IDelivery $delivery)
    {
        $this->delivery = $delivery;
    }

    public function index(Request $request)
    {
        return $this->delivery->get($request);
    }
}
