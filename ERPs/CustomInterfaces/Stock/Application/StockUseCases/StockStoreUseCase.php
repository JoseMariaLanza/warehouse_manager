<?php

namespace ERPs\CustomInterfaces\Stock\Application\StockUseCases;

use Exception;
use Illuminate\Http\Request;

use App\ApiResponse;
use Core\Stock\Domain\StockService;
use Core\Stock\Infrastructure\Validations\Stock\StockValidation;

class StockStoreUseCase
{
    static function store(Request $request)
    {
        try {
            if (!StockValidation::validateStore($request)) {
                return ApiResponse::badRequest('HERE GOES YOUR CUSTOM ERROR!!.');
            }

            return StockService::store($request);
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }
}
