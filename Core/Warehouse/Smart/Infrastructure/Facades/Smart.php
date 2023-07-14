<?php

namespace Core\Warehouse\Smart\Infrastructure\Facades;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Facade;

use App\ApiResponse;
use Core\Warehouse\Smart\Infrastructure\ISmart;
use Core\Warehouse\Smart\Domain\SmartService;

// Esto es a modo de ejemplo, pueden modificarse, eliminarse o agregarse
// use Core\Warehouse\Smart}}\Infrastructure\Validations\SmartStoreValidation;
// use Core\Warehouse\Smart}}\Infrastructure\Validations\SmartUpdateValidation;
// use Core\Warehouse\Smart}}\Infrastructure\Validations\SmartGetValidation;
// use Core\Warehouse\Smart}}\Infrastructure\Validations\SmartDeleteValidation;

class Smart extends Facade implements ISmart // Podés implementar otra interface aparte de esta poniendo una coma y el nombre de la interfaz
{
    protected static function getFacadeAccessor()
    {
        return 'smart';
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
