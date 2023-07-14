<?php

namespace ERPs\CustomInterfaces\Stock\Domain\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Stock\Stock;

// IMPORTANTE!!: El Repository es SOLO para obtener datos externos de la applicación
// si solo se hace una consulta simple al modelo que no requiera de una logica/procesamiento de estos datos
// esta debe hacerse en el servicio y esta clase debe ser eliminada. Caso contrario se debe usar el Repository
class StockRepository
{
    public static function store($request) : Stock
    {
        // Cambiar $modelName por el nombre del modelo correspondiente
        $modelName = new Stock();

        // Code ...

        //return $datosProcesados
    }

    public static function update() : Stock
    {
        // Code ...
    }

    public static function get($id) : Stock
    {
        // Code ...
    }

    public static function delete($id)
    {
        // Code ...
    }
}
