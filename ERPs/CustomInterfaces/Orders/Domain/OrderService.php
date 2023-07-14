<?php

namespace ERPs\CustomInterfaces\Orders\Domain;

use Exception;
use Illuminate\Http\Request;

use App\ApiResponse;
// Este servicio se comunica con el repositorio mediante el siguente use:
use ERPs\CustomInterfaces\Orders\Domain\Repositories\OrderRepository;
// IMPORTANTE!!: Si no se necesita usar el repositorio anterior este debe eliminarse


class OrderService
{

    public static function store(Request $request)
    {
        try {
            // Code ...
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }

    public static function update(Request $request)
    {
        try {
            // Code ...
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }

    public static function get($par = null)
    {
        try {
            // Code ...
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }

    public static function delete()
    {
        try {
            // Code ...
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }
}
