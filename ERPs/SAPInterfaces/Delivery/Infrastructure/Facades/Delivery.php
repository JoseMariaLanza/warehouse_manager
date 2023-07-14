<?php

namespace ERPs\SAPInterfaces\Delivery\Infrastructure\Facades;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

use App\ApiResponse;
use ERPs\SAPInterfaces\Delivery\Infrastructure\IDelivery;
use ERPs\SAPInterfaces\Delivery\Domain\DeliveryService;

class Delivery extends Facade implements IDelivery
{
    protected static function getFacadeAccessor()
    {
        return 'delivery';
    }

    public function get(Request $request)
    {
        try {
            $deliveryService = new DeliveryService();

            return ApiResponse::ok(
                'Delivery data retrieved successfuly.',
                'data',
                $deliveryService->get($request)
            );
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }
}
