<?php

namespace Core\Shifts\Domain;

use Exception;
use Illuminate\Http\Request;

use App\ApiResponse;
use Core\Deposito;
// Este servicio se comunica con el repositorio mediante el siguente use:
use Core\Shifts\Domain\Repositories\ShiftRepository;
use ERPs\SAPInterfaces\Orders\Domain\OrderService;
use ERPs\SAPInterfaces\Client\Domain\ClientService;

// IMPORTANTE!!: Si no se necesita usar el repositorio anterior este debe eliminarse


class ShiftService
{

    public static function get(Request $request)
    {
        $shift = null;
        // EL CODIGO DE CLIENTE DEBE VENIR EN EL REQUEST

        // // Comunicación entre servicios ShiftService <-> ClientService
        $customerSAPData = new ClientService();
        // return $customerSAPData->get($request);
        // // return $customerSAPData->get([
        // //     'clientCode' => '30000697',
        // // ]);

        // Comunicación entre servicios ShiftService <-> OrderService
        $orderSAPData = new OrderService();
        return [
            'customerData' => $customerSAPData->get($request),
            'orderList' => $orderSAPData->get($request),
        ];

        // $clientData = new Client();
        // return $clientData->get([
        //     'clientCode' => '30000697',
        // ]);

        // $clientDataAndOrders = new Order();
        // return $clientDataAndOrders->get([
        //     'client_code'   => '30000697',
        //     'storage'      => Deposito::DEPOSITO_TUC
        // ]);
        $shift = ShiftRepository::get();
        return $shift;
    }

    public static function getFiltered($request)
    {

        $shift = ShiftRepository::getFiltered($request);

        return $shift;
    }

    public static function store(Request $request)
    {
        try {
            $shift = ShiftRepository::store($request);
            return $shift;
        } catch (Exception $ex) {
            return ApiResponse::serverError($ex->getMessage());
        }
    }

    public static function update(Request $request)
    {

        try {
            $shift = ShiftRepository::update($request);
            return $shift;
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
