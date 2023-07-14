<?php

namespace ERPs\SAPInterfaces\Orders\Infrastructure\Facades;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

use App\ApiResponse;
use ERPs\SAPInterfaces\Orders\Infrastructure\IOrder;
use ERPs\SAPInterfaces\Orders\Domain\OrderService;

class Order extends Facade implements IOrder
{
    protected static function getFacadeAccessor()
    {
        return 'order';
    }

    public function get($request)
    {
        try {
            $orderService = new OrderService();

            return ApiResponse::ok('Orders retrieved successfuly.', 'data', $orderService->get($request));
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }

    public function post(Request $request)
    {
        //
    }
}
