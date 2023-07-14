<?php

namespace Core\Shifts\Domain\Repositories;

use Illuminate\Support\Facades\DB;
use App\ApiResponse;
use App\Models\Shifts\Shift;


// IMPORTANTE!!: El Repository es SOLO para obtener datos externos de la applicación
// si solo se hace una consulta simple al modelo que no requiera de una logica/procesamiento de estos datos
// esta debe hacerse en el servicio y esta clase debe ser eliminada. Caso contrario se debe usar el Repository
class ShiftRepository
{
    public static function get()
    {
        return Shift::paginate(5);
    }

    public static function getFiltered($request)
    {
        //Desarrollo consulta a modo de ejemplo
        return Shift::where('id', $request->turno_id)->orWhere('user_id', $request->user_id)->get();
    }

    public static function store($request)
    {
        try {
            $shift = new Shift();
            $shift->user_id = $request->user_id;
            $shift->status = $request->status;
            $shift->driver_identification = $request->driver_identification;
            $shift->shift_date = $request->shift_date;
            $shift->start_time = $request->start_time;
            $shift->finish_time = $request->finish_time;
            $shift->init_weight = $request->init_weight;
            $shift->final_weight = $request->final_weight;
            $shift->remit = $request->remit;
            $shift->assigned_shipment_street = $request->assigned_shipment_street;
            $shift->shift_type = $request->shift_type;
            $shift->vip_shift = $request->vip_shift;
            $shift->state_province = $request->state_province;

            $shift->save();

            return $shift;
        } catch (\Exception $ex) {
            return ApiResponse::serverError('Error creating a shift.');
        }
    }

    public static function update($request)
    {
        try {
            $shift = Shift::where('id', $request->id)->first();

            if ($shift) {
                $shift->status = $request->status;
            }

            $shift->update();

            return $shift;
        } catch (\Exception $ex) {
            return ApiResponse::serverError('Error updating a shift.');
        }
    }
}
