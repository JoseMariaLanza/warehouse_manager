<?php

namespace ERPs\SAPInterfaces\Stock\Domain;


class Stock
{
    private $header;
    private $error;
    private $positions;

    public function __construct(object $stock)
    {
        $this->setHeader($stock->PE_CABECERA);

        $this->error = $stock->PE_ERROR;

        $this->buildPositions($stock);
    }

    public function buildPositions($order)
    {
        $this->positions = collect();
        if (isset($order->PE_T_POSICIONES->item) && !is_object($order->PE_T_POSICIONES->item)) {
            $positions = $order->PE_T_POSICIONES->item;
        } else {
            $positions[0] = $order->PE_T_POSICIONES->item;
        }
        foreach ($positions as $position) {
            $this->addPosition((new Position($position))->get());
        }
    }

    private function setHeader($header)
    {
        $this->header = (new Header($header))->get();
    }

    private function addPosition($position)
    {
        $this->positions->add($position);
    }

    public function get()
    {
        return [
            'header' => $this->header,
            'error' => $this->error,
            'positions' => $this->positions,
        ];
    }
}
