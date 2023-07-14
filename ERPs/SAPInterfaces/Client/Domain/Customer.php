<?php

namespace ERPs\SAPInterfaces\Client\Domain;


class Customer
{
    private $channel;
    private $clientCode;
    private $error;
    private $mail;
    private $businessName;

    public function __construct(object $data)
    {
        // Dejo codigo comentado a modo de ejemplo para tener en
        // cuenta otra forma de setear los datos
        // se puede llamar al método set en otra parte en lugar de
        // que sea obligatorio pasar los datos en el constructor
        // $this->set($data);
        $this->channel = $data->PE_CANAL;
        $this->clientCode = $data->PE_CLIENTE;
        $this->error = $data->PE_ERROR;
        $this->mail = $data->PE_MAIL;
        $this->businessName = $data->PE_RAZON_SOCIAL;
    }

    public function get()
    {
        return [
            'channel' => $this->channel,
            'clientCode' => $this->clientCode,
            'error' => $this->error,
            'mail' => $this->mail,
            'businessName' => $this->businessName,
        ];
    }

    // private function set($data)
    // {
    //     $this->channel = $data['PE_CANAL'];
    //     $this->clientCode = $data['PE_CLIENTE'];
    //     $this->error = $data['PE_ERROR'];
    //     $this->mail = $data['PE_MAIL'];
    //     $this->businessName = $data['PE_RAZON_SOCIAL'];
    // }
}
