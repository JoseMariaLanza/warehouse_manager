<?php

namespace Core\Shifts\Application\ShiftUseCases;

use Exception;
use Illuminate\Http\Request;

use App\ApiResponse;
use Core\Shifts\Domain\ShiftService;
use Core\Shifts\Infrastructure\Validations\Shift\ShiftValidation;


class ShiftUpdateUseCase
{
    static function update(Request $request)
    {
        try {
            if (!ShiftValidation::validateUpdate($request)) {
                return ApiResponse::badRequest('HERE GOES YOUR CUSTOM ERROR!!.');
            }
            return ShiftService::update($request);
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }
}
