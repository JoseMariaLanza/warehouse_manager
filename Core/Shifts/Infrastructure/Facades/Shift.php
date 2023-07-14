<?php

namespace Core\Shifts\Infrastructure\Facades;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

use App\ApiResponse;
use App\ResponseType;
use Core\Shifts\Application\ShiftUseCases\ShiftGetUseCase;
use Core\Shifts\Application\ShiftUseCases\ShiftStoreUseCase;
use Core\Shifts\Application\ShiftUseCases\ShiftUpdateUseCase;
use Core\Shifts\Infrastructure\IShift;

// Esto es a modo de ejemplo, pueden modificarse, eliminarse o agregarse
// use Core\Shifts}}\Infrastructure\Validations\ShiftStoreValidation;
// use Core\Shifts}}\Infrastructure\Validations\ShiftUpdateValidation;
// use Core\Shifts}}\Infrastructure\Validations\ShiftGetValidation;
// use Core\Shifts}}\Infrastructure\Validations\ShiftDeleteValidation;

class Shift extends Facade implements IShift // Podés implementar otra interface aparte de esta poniendo una coma y el nombre de la interfaz
{
    protected static function getFacadeAccessor()
    {
        return 'shift';
    }

    private $responseType;

    public function __construct(ResponseType $responseType)
    {
        $this->responseType = $responseType;
    }

    public function get($request = null)
    {
        try {
            return $response = ShiftGetUseCase::get($request);

            $data = $this->responseType->parse($response->toArray());

            return ApiResponse::ok('Shifts obtained successfuly.', 'page', $data);
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }

    function getFiltered(Request $request)
    {

        try {
            $response = ShiftGetUseCase::getFiltered($request);
            $data = $this->responseType->parse($response->toArray());

            return ApiResponse::ok('Shifts obtained successfuly.', 'page', $data);
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }

    function store(Request $request)
    {
        try {
            $response = ShiftStoreUseCase::store($request);

            $data = $this->responseType->parse($response->toArray());

            return ApiResponse::ok('Shift created successfuly.', 'page', $data);
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }

    function update(Request $request)
    {
        try {
            $response = ShiftUpdateUseCase::update($request);

            $data = $this->responseType->parse($response->toArray());

            return ApiResponse::ok('Shift updated successfuly.', 'page', $data);
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }
}
