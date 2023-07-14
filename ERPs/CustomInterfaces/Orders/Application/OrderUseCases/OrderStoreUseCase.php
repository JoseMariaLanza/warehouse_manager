<?php

namespace ERPs\CustomInterfaces\Orders\Application\OrderUseCases;

use Exception;
use Illuminate\Http\Request;

use App\ApiResponse;
use Core\Orders\Domain\OrderService;
use Core\Orders\Infrastructure\Validations\Order\OrderValidation;

class OrderStoreUseCase
{
    static function store(Request $request)
    {
        try {
            if (!OrderValidation::validateStore($request)) {
                return ApiResponse::badRequest('HERE GOES YOUR CUSTOM ERROR!!.');
            }

            return OrderService::store($request);
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }
}
