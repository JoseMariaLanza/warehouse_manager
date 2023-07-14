<?php

namespace Core\Shifts\Application\ShiftUseCases;

use Exception;
use Illuminate\Http\Request;

use App\ApiResponse;
use Core\Shifts\Domain\ShiftService;

class ShiftGetUseCase
{
    static function get($par)
    {
        try {
            return ShiftService::get($par);
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }

    static function getFiltered(Request $request)
    {
        try {
            return ShiftService::getFiltered($request);
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }
}
