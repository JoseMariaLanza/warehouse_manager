<?php

namespace ERPs\SAPInterfaces\Delivery\Domain;


class Delivery
{
    private $header;
    private $positions;

    public function __construct(object $delivery)
    {
        $this->setHeader($delivery->CABECERA);

        $this->buildPositions($delivery);
    }

    public function buildPositions($delivery)
    {
        $this->positions = collect();
        if (isset($delivery->POSICIONES->item) && !is_object($delivery->POSICIONES->item)) {
            $positions = $delivery->POSICIONES->item;
        } else {
            $positions[0] = $delivery->POSICIONES->item;
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
            'positions' => $this->positions,
        ];
    }
}
