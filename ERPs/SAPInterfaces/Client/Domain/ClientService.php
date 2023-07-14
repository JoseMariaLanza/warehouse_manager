<?php

namespace ERPs\SAPInterfaces\Client\Domain;

use ERPs\SAPInterfaces\SAPAdapter;
use Illuminate\Http\Request;

class ClientService extends SAPAdapter
{
    protected $serviceUrl = 'zsd_get_custom_data';
    protected $function = 'Z_FSD_GET_CUSTOM_DATA';

    public function get(Request $request)
    {
        $params = array(
            "PI_CLIENTE"    => $request->clientCode,
        );
        $sapResponse = $this->call($params, $this->function, $this->serviceUrl);
        return (new Customer($sapResponse))->get();
    }
}
