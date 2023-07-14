<?php

namespace Core\Warehouse\Smart\Application\SmartUseCases;

use Exception;
use Illuminate\Http\Request;

use App\ApiResponse;
use Core\Smart\Domain\SmartService;
use Core\Smart\Infrastructure\Validations\Smart\SmartValidation;

class SmartStoreUseCase
{
    static function store(Request $request)
    {
        try {
            if (!SmartValidation::validateStore($request)) {
                return ApiResponse::badRequest('HERE GOES YOUR CUSTOM ERROR!!.');
            }

            return SmartService::store($request);
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }
}
