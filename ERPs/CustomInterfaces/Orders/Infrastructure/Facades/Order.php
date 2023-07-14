<?php

namespace ERPs\CustomInterfaces\Orders\Infrastructure\Facades;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

use App\ApiResponse;
use ERPs\CustomInterfaces\Orders\Infrastructure\IOrder;
use ERPs\CustomInterfaces\Orders\Domain\OrderService;

// Esto es a modo de ejemplo, pueden modificarse, eliminarse o agregarse
// use ERPs\CustomInterfaces\Orders}}\Infrastructure\Validations\OrderStoreValidation;
// use ERPs\CustomInterfaces\Orders}}\Infrastructure\Validations\OrderUpdateValidation;
// use ERPs\CustomInterfaces\Orders}}\Infrastructure\Validations\OrderGetValidation;
// use ERPs\CustomInterfaces\Orders}}\Infrastructure\Validations\OrderDeleteValidation;

class Order extends Facade implements IOrder // Podés implementar otra interface aparte de esta poniendo una coma y el nombre de la interfaz
{
    protected static function getFacadeAccessor()
    {
        return 'order';
    }

    function store(Request $request)
    {
        try {
            // Tu codigo va aquí papilo
            // comunicate con la capa de Aplicacion en el servicio respectivo
            // no me hagas renegar
        } catch (Exception $ex) {
            // ApiResponse server error
        }
    }

    function update(Request $request)
    {
        try {
            // Tu codigo va aquí papilo
            // comunicate con la capa de Aplicacion en el servicio respectivo
            // no me hagas renegar
        } catch (Exception $ex) {
            // ApiResponse server error
        }
    }

    function get($par = null)
    {
        try {
            // Tu codigo va aquí papilo
            // comunicate con la capa de Aplicacion en el servicio respectivo
            // no me hagas renegar
        } catch (Exception $ex) {
            // ApiResponse server error
        }
    }

    function delete()
    {
        try {
            // Tu codigo va aquí papilo
            // comunicate con la capa de Aplicacion en el servicio respectivo
            // no me hagas renegar
        } catch (Exception $ex) {
            // ApiResponse server error
        }
    }
}
