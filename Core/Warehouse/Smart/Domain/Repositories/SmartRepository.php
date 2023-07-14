<?php

namespace Core\Warehouse\Smart\Domain\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Smart\Smart;

// IMPORTANTE!!: El Repository es SOLO para obtener datos externos de la applicación
// si solo se hace una consulta simple al modelo que no requiera de una logica/procesamiento de estos datos
// esta debe hacerse en el servicio y esta clase debe ser eliminada. Caso contrario se debe usar el Repository
class SmartRepository
{
    public static function store($request) : Smart
    {
        // Cambiar $modelName por el nombre del modelo correspondiente
        $modelName = new Smart();

        // Code ...

        //return $datosProcesados
    }

    public static function update() : Smart
    {
        // Code ...
    }

    public static function get($id) : Smart
    {
        // Code ...
    }

    public static function delete($id)
    {
        // Code ...
    }
}
