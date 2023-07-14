<?php

namespace ERPs\SAPInterfaces\Orders\Domain;

use ERPs\SAPInterfaces\SAPAdapter;

// IMPORTANTE!!: Si no se necesita usar el repositorio anterior este debe eliminarse


class OrderService extends SAPAdapter
{
    protected $serviceUrl = 'zsd_get_sales_orders';
    protected $function = 'Z_FSD_GET_SALES_ORDERS';

    public function get($input)
    {
        $params = array(
            "PI_CLIENTE" => $input['clientCode'] ?? null,
            "PI_DEPOSITO" => $input['storage'] ?? null,
        );
        $sapResponse = $this->call($params, $this->function, $this->serviceUrl);
        return (new OrderCollection($sapResponse))->get();
    }
}
