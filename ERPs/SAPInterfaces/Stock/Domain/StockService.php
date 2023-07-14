<?php

namespace ERPs\SAPInterfaces\Stock\Domain;

use ERPs\SAPInterfaces\SAPAdapter;

class StockService extends SAPAdapter
{

    protected $serviceUrl = 'zmm_get_stock_material';
    protected $function = 'Z_FMM_GET_STOCK_MATERIAL';

    public function get($input)
    {
        $params = array(
            "PI_MATERIAL" => $input['productCode'] ?? null,
            "PI_DEPOSITO" => $input['storage'] ?? null,
        );
        $sapResponse = $this->call($params, $this->function, $this->serviceUrl);
        return (new Stock($sapResponse))->get();
    }
}
