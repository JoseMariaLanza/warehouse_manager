<?php

namespace ERPs\SAPInterfaces\Stock\Domain;

use Carbon\Carbon;

class Position
{
    private $position;              // POSNR	"000010"
    private $date;           // MATNR	"000000009000000006" --> Código del material
    private $stock;

    public function __construct(object $product)
    {
        if ($this->validateProduct($product)) {
            $this->position = (int)trim($product->POSNR);
            $this->date = $this->formatDate(trim($product->FECHA));
            $this->stock = floatval(trim($product->STOCK));
        }
    }

    private function formatDate($string)
    {
        $year = substr($string, -8, 4);
        $month = substr($string, -4, 2);
        $day = substr($string, -2, 2);
        return Carbon::create($year . '-' . $month . '-' . $day);
    }

    private function validateProduct(object $product): bool
    {
        if (isset($product->POSNR)) {
            return true;
        }
        return false;
    }

    public function get()
    {
        return [
            'position' => $this->position,
            'date' => $this->date,
            'stock' => $this->stock,
        ];
    }
}
