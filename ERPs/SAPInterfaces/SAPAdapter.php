<?php

namespace ERPs\SAPInterfaces;

use Core\Account\Domain\AccountService;
use Illuminate\Support\Facades\Config;

class SAPAdapter
{
    protected $environment;
    protected $port;
    protected $user;
    protected $password;

    public function __construct()
    {
        $this->port = Config::get('app.sap_port');
        $this->environment = Config::get('app.sap_env');
        $customer = self::SAPCredentials();
        $this->user = $customer['SAP_USER'];
        $this->password = $customer['SAP_PASSWORD'];
    }

    private static function sapCredentials()
    {
        $customer = AccountService::getClient();
        return [
            'SAP_USER'      => $customer->erp_user,
            'SAP_PASSWORD'  => $customer->erp_code,
        ];
    }

    protected function getURl($port, $serviceUrl, $environment)
    {
        return 'http://test.com:' .
            $port . 'sap/port' .
            $serviceUrl . '?sap-client=' . $environment;
    }

    public function call(array $params, $function, $serviceUrl)
    {
        $wsdl = $this->getURl($this->port, $serviceUrl, $this->environment);

        $client = new \SoapClient($wsdl, array(
            'login' => $this->user,
            'password' => $this->password,
            'encoding' => 'UTF-8',
            'soap_version' => 'SOAP_1_2',
            'trace' => true
        ));

        return $client->__soapCall($function, array($params));
    }
}
