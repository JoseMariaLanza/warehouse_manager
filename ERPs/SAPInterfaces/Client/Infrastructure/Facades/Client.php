<?php

namespace ERPs\SAPInterfaces\Client\Infrastructure\Facades;

use App\ApiResponse;
// use App\ResponseType;
use Illuminate\Support\Facades\Facade;

use ERPs\SAPInterfaces\Client\Infrastructure\IClient;
use ERPs\SAPInterfaces\Client\Domain\ClientService;
use Exception;
use Illuminate\Http\Request;

class Client extends Facade implements IClient
{
    protected static function getFacadeAccessor()
    {
        return 'client';
    }

    public function get(Request $request)
    {
        try {
            $clientService = new ClientService();
            // return $clientService->get($request);

            return ApiResponse::ok('Customer data retrieved successfuly.', 'data', $clientService->get($request));
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }
}
