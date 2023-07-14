<?php

namespace ERPs\SAPInterfaces\Delivery\Domain;

use Carbon\Carbon;

class Position
{
    private $orderNumber;
    private $position; // Según la implementación en la PA vieja,
    //la posición es la línea de venta
    private $productCode;
    private $description;
    private $quantity;
    private $meUnit; // measurement unit = unidad de medida
    private $productCategory;

    public function __construct(object $position)
    {
        if ($this->validatePosition($position)) {
            $this->orderNumber = (int)trim($position->VBELN);
            $this->position = (int)trim($position->POSNR);
            $this->productCode = (int)trim($position->MATNR);
            $this->description = trim($position->MAKTX);
            $this->quantity = floatval(trim($position->LFIMG));
            $this->meUnit = trim($position->VRKME);
            $this->productCategory = trim($position->MATKL);
        }
    }

    private function validatePosition(object $position): bool
    {
        if (isset($position->POSNR)) {
            return true;
        }
        return false;
    }

    public function get()
    {
        return [
            'orderNumber' => $this->orderNumber,
            'position' => $this->position,
            'productCode' => $this->productCode,
            'description' => $this->description,
            'quantity' => $this->quantity,
            'meUnit' => $this->meUnit,
            'productCategory' => $this->productCategory,
        ];
    }
}
