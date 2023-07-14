<?php

namespace Core\Shifts\Application\ShiftUseCases;

use Exception;
use Illuminate\Http\Request;

use App\ApiResponse;
use Core\Shifts\Domain\ShiftService;
use Core\Shifts\Infrastructure\Validations\Shift\ShiftValidation;

class ShiftStoreUseCase
{
    static function store(Request $request)
    {
        try {
            if (!ShiftValidation::validateStore($request)) {
                return ApiResponse::badRequest('HERE GOES YOUR CUSTOM ERROR!!.');
            }

            return ShiftService::store($request);
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }
}
