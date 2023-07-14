<?php

namespace ERPs\CustomerInterfaces\Stock\Infrastructure\Facades;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

use App\ApiResponse;
use ERPs\CustomerInterfaces\Stock\Infrastructure\IStock;
use ERPs\CustomerInterfaces\Stock\Domain\StockService;

// Esto es a modo de ejemplo, pueden modificarse, eliminarse o agregarse
// use ERPs\CustomerInterfaces\Stock}}\Infrastructure\Validations\StockStoreValidation;
// use ERPs\CustomerInterfaces\Stock}}\Infrastructure\Validations\StockUpdateValidation;
// use ERPs\CustomerInterfaces\Stock}}\Infrastructure\Validations\StockGetValidation;
// use ERPs\CustomerInterfaces\Stock}}\Infrastructure\Validations\StockDeleteValidation;

class Stock extends Facade implements IStock // Podés implementar otra interface aparte de esta poniendo una coma y el nombre de la interfaz
{
    protected static function getFacadeAccessor()
    {
        return 'stock';
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
