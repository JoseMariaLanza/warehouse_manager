<?php

namespace ERPs\SAPInterfaces\Stock\Infrastructure\Facades;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

use App\ApiResponse;
use ERPs\SAPInterfaces\Stock\Infrastructure\IStock;
use ERPs\SAPInterfaces\Stock\Domain\StockService;

class Stock extends Facade implements IStock
{
    protected static function getFacadeAccessor()
    {
        return 'stock';
    }

    public function get(Request $request)
    {
        try {
            $stockService = new StockService();

            return ApiResponse::ok('Stock data retrieved successfuly.', 'data', $stockService->get($request));
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }
}
