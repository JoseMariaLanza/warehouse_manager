<?php

namespace ERPs\SAPInterfaces\Delivery\Domain;

use ERPs\SAPInterfaces\SAPAdapter;

class DeliveryService extends SAPAdapter
{

    protected $serviceUrl = 'zsd_get_delivery_data';
    protected $function = 'Z_FSD_GET_DELIVERY_DATA';

    public function get($input)
    {
        $params = array(
            "PI_CLIENTE" => $input['clientCode'] ?? null,
            "PI_DEPOSITO" => $input['storage'] ?? null,
        );
        $sapResponse = $this->call($params, $this->function, $this->serviceUrl);
        return (new DeliveryCollection($sapResponse))->get();
    }
}
