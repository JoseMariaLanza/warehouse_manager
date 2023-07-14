<?php

namespace ERPs\CustomInterfaces\Orders\Domain\Repositories;

use Illuminate\Support\Facades\DB;
use App\Models\Orders\Order;

// IMPORTANTE!!: El Repository es SOLO para obtener datos externos de la applicación
// si solo se hace una consulta simple al modelo que no requiera de una logica/procesamiento de estos datos
// esta debe hacerse en el servicio y esta clase debe ser eliminada. Caso contrario se debe usar el Repository
class OrderRepository
{
    public static function store($request) : Order
    {
        // Cambiar $modelName por el nombre del modelo correspondiente
        $modelName = new Order();

        // Code ...

        //return $datosProcesados
    }

    public static function update() : Order
    {
        // Code ...
    }

    public static function get($id) : Order
    {
        // Code ...
    }

    public static function delete($id)
    {
        // Code ...
    }
}
